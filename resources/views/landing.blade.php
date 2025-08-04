<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sample API for Testing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .section {
            margin-bottom: 2rem;
        }
        pre {
            background: #222;
            color: #eee;
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 0.9rem;
        }
        code {
            color: #f8d27c;
        }
        input, button {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center text-primary">📦 Sample API for Testing</h1>

        <div class="section">
            <p>This API supports GET methods for the following sample data:</p>
            <ul>
                <li>📚 Books</li>
                <li>🍎 Fruits</li>
                <li>👤 Persons</li>
                <li>🛒 Products</li>
                <li>🏭 Manufacturers</li>
            </ul>
            <p>Base URL: <code>http://localhost/api/v1</code></p>
        </div>

        <div class="section">
            <h3>🍎 Fruit API – GET Endpoints</h3>

            <h5>🔹 View a Random Fruit</h5>
            <pre><code>GET /api/v1/fruit</code></pre>
            <pre><code>curl http://localhost/api/v1/fruit</code></pre>

            <hr>

            <h5>🔹 View All Fruits (with Filter)</h5>
            <pre><code>GET /api/v1/fruits?limit=3&fields=id,name</code></pre>
            <pre><code>curl "http://localhost/api/v1/fruits?limit=3&fields=id,name"</code></pre>

            <form id="fruit-form" class="mt-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <input type="number" id="limit" class="form-control" placeholder="Limit (e.g. 5)">
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="fields" class="form-control" placeholder="Fields (e.g. id,name)">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Try It</button>
                    </div>
                </div>
            </form>

            <div class="mt-4">
                <p><strong>Live API JSON Response:</strong></p>
                <pre id="api-response"><code>Waiting for query...</code></pre>
            </div>
        </div>

        <div class="section text-center">
            <p class="text-muted">Only GET routes are shown publicly. More will be added soon.</p>
            <p class="text-muted">Happy Testing! 🚀</p>
        </div>
    </div>

    <script>
        const form = document.getElementById('fruit-form');
        const responseBox = document.getElementById('api-response');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const limit = document.getElementById('limit').value;
            const fields = document.getElementById('fields').value;

            let url = "http://127.0.0.1:8000/api/v1/fruits";
            const params = [];

            if (limit) params.push(`limit=${encodeURIComponent(limit)}`);
            if (fields) params.push(`fields=${encodeURIComponent(fields)}`);

            if (params.length) {
                url += "?" + params.join("&");
            }

            responseBox.innerHTML = "<code>Loading...</code>";

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const formatted = JSON.stringify(data, null, 2);
                    responseBox.innerHTML = `<code>${formatted}</code>`;
                })
                .catch(err => {
                    responseBox.innerHTML = '<code style="color:red;">Failed to fetch API response.</code>';
                });
        });
    </script>
</body>
</html>
