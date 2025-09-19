<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sample API Testing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Prism.js for JSON syntax highlighting -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css">

    <style>
        body {
            background-color: #f9f9f9;
        }

        pre {
            background: #1e1e1e;
            color: #eee;
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
        }

        code {
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
        }

        .json-response {
            font-size: 0.85rem;
        }

        .tab-pane .form-control {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center text-primary">📦 Sample API for Testing</h1>

        <p>This API supports GET methods for the following sample data:</p>
        <ul>
            <li>📚 Books</li>
            <li>🍎 Fruits</li>
            <li>👤 Persons</li>
            <li>🛒 Products</li>
            <li>🏭 Manufacturers</li>
        </ul>
        <p>Base URL: <code>{{ env('APP_URL', 'http://127.0.0.1:8000') }}/api/v1</code></p>

        <!-- Navigation tabs for different entities -->
        <ul class="nav nav-tabs" id="apiTabs" role="tablist">
            @php
                // Define entities and their labels
                $entities = [
                    'fruits' => ['label' => '🍎 Fruits', 'single' => 'fruit'],
                    'books' => ['label' => '📚 Books', 'single' => 'book'],
                    'people' => ['label' => '👤 Persons', 'single' => 'person'],
                    'products' => ['label' => '🛒 Products', 'single' => 'product'],
                    'manufacturers' => ['label' => '🏭 Manufacturers', 'single' => 'manufacturer'],
                ];
            @endphp
            @foreach ($entities as $key => $entity)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if ($loop->first) active @endif" id="{{ $key }}-tab" data-bs-toggle="tab"
                        data-bs-target="#tab-{{ $key }}" type="button" role="tab" aria-controls="tab-{{ $key }}"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                        data-single="{{ $entity['single'] }}">
                        {{ $entity['label'] }}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Tab content for each entity -->
        <div class="tab-content mt-4" id="apiTabsContent">
            @foreach ($entities as $key => $entity)
                <div class="tab-pane fade @if ($loop->first) show active @endif" id="tab-{{ $key }}" role="tabpanel"
                    aria-labelledby="{{ $key }}-tab">
                    <h4>{{ $entity['label'] }} API</h4>

                    <!-- Form for listing API -->
                    <form class="api-form row g-2 align-items-center"
                        data-entity="{{ $key }}"
                        data-single="{{ $entity['single'] }}"
                        data-type="list">
                        <div class="col-md-2">
                            <input type="number" name="limit" class="form-control" placeholder="Limit">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fields" class="form-control" placeholder="Fields (e.g. id,name)">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pagination" class="form-control" placeholder="Pagination(1,2)(page no. and per page)">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Try It</button>
                        </div>
                    </form>

                    <div class="mt-3">
                        <strong>🔧 cURL Command:</strong>
                        <pre><code class="language-bash curl-preview">curl {{ env('APP_URL', 'http://127.0.0.1:8000') }}/api/v1/{{ $key }}</code></pre>
                    </div>

                    <div class="mt-3">
                        <strong>📦 Live API JSON Response:</strong>
                        <pre><code class="language-bash curl-preview" data-type="list">...</code></pre>
                        <pre class="json-response language-json" data-type="list"><code class="language-json">Waiting for query...</code>
                        </pre>
                    </div>

                    <hr class="my-4">

                    <!-- Get Random Item -->
                    <h5>🎲 Get a Random {{ ucfirst($key) }}</h5>
                    <div class="mt-2">
                        <strong>🔧 cURL Command:</strong>
                        <pre><code class="language-bash">curl {{ env('APP_URL', 'http://127.0.0.1:8000') }}/api/v1/{{ $entity['single'] }}</code></pre>
                    </div>

                    <div class="mt-2">
                        <strong>📦 Live JSON Response:</strong>
                        <pre class="json-response-random language-json"><code class="language-json" id="random-{{ $key }}">Loading random item...</code>
                        </pre>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="section text-center mt-5">
            <p class="text-muted">Only GET routes are shown publicly. More will be added soon.</p>
            <p class="text-muted">Happy Testing! 🚀</p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-json.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/components/prism-bash.min.js"></script>

    <script>
        // Add event listeners to all API forms for handling submissions
        document.querySelectorAll('.api-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const entity = this.dataset.entity;
                const type = this.dataset.type;
                const tab = this.closest('.tab-pane');
                
                let url = `${env('APP_URL', 'http://127.0.0.1:8000')}/api/v1/${entity}`;
                let curlText = '';
                const curlBox = tab.querySelector(`.curl-preview[data-type="${type}"]`);
                const responseBox = tab.querySelector(`.json-response[data-type="${type}"] code`);

                // Build URL based on form inputs
                if (type === 'list') {
                    const limit = this.querySelector('[name="limit"]').value;
                    const fields = this.querySelector('[name="fields"]').value;
                    const pagination = this.querySelector('[name="pagination"]').value;

                    const params = [];

                    if (limit) params.push(`limit=${encodeURIComponent(limit)}`);
                    if (fields) params.push(`fields=${encodeURIComponent(fields)}`);
                    if (pagination) params.push(`pagination=${encodeURIComponent(pagination)}`);
                    if (params.length) url += `?${params.join("&")}`;

                } else if (type === 'single') {
                    const id = this.querySelector('[name="id"]').value.trim();
                    if (!id) {
                        responseBox.textContent = '❌ Please enter a valid ID.';
                        Prism.highlightElement(responseBox);
                        return;
                    }
                    url += `/${encodeURIComponent(id)}`;
                }

                // Update cURL command preview
                curlText = `curl "${url}"`;
                curlBox.textContent = curlText;
                Prism.highlightElement(curlBox);

                // Show loading text while fetching data
                responseBox.textContent = 'Loading...';
                Prism.highlightElement(responseBox);

                // Fetch API data
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        responseBox.textContent = JSON.stringify(data, null, 2);
                        Prism.highlightElement(responseBox);
                    })
                    .catch(() => {
                        responseBox.textContent = '❌ Failed to fetch API response.';
                        Prism.highlightElement(responseBox);
                    });
            });
        });

        // Event listeners for tab switching and loading random API data
        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tabBtn => {
            tabBtn.addEventListener('shown.bs.tab', function (e) {
                const tabId = e.target.getAttribute('data-bs-target');
                const tabPane = document.querySelector(tabId);
                const entity = e.target.id.replace('-tab', '');
                const single = this.dataset.single;
                const randomCode = tabPane.querySelector(`#random-${entity}`);
                const url = `http://127.0.0.1:8000/api/v1/${single}`;   

                randomCode.textContent = 'Loading...';
                Prism.highlightElement(randomCode);

                // Fetch random API data
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        randomCode.textContent = JSON.stringify(data, null, 2);
                        Prism.highlightElement(randomCode);
                    })
                    .catch(() => {
                        randomCode.textContent = '❌ Failed to fetch random API response.';
                        Prism.highlightElement(randomCode);
                    });
            });

            // Load first tab random by default
            if (tabBtn.classList.contains('active')) {
                tabBtn.dispatchEvent(new Event('shown.bs.tab'));
            }
        });
    </script>

</body>

</html>
