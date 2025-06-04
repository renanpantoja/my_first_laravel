<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Documentação API Jobs</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        pre { background: #f4f4f4; padding: 10px; }
        code { background: #eee; padding: 2px 4px; }
        h1, h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Documentação da API /api/v1/jobs</h1>

    <h2>Filtros disponíveis</h2>
    <table>
        <thead>
            <tr><th>Parâmetro</th><th>Tipo</th><th>Descrição</th><th>Exemplo</th></tr>
        </thead>
        <tbody>
            <tr><td>tags</td><td>string</td><td>Filtra vagas pelas tags (vírgula-separadas)</td><td>Paperhanger,Forensic Investigator</td></tr>
            <tr><td>salary_min</td><td>integer</td><td>Salário mínimo (sem $ e vírgulas)</td><td>60000</td></tr>
            <tr><td>salary_max</td><td>integer</td><td>Salário máximo (sem $ e vírgulas)</td><td>80000</td></tr>
            <tr><td>location</td><td>string</td><td>Localização exata</td><td>Remote</td></tr>
            <tr><td>featured</td><td>integer</td><td>Destaque (0 ou 1)</td><td>1</td></tr>
            <tr><td>title</td><td>string</td><td>Filtra título com LIKE</td><td>Analyst</td></tr>
            <tr><td>employer</td><td>string</td><td>Filtra nome do empregador com LIKE</td><td>Smith</td></tr>
            <tr><td>per_page</td><td>integer</td><td>Itens por página (default 15)</td><td>5</td></tr>
            <tr><td>page</td><td>integer</td><td>Página atual (default 1)</td><td>2</td></tr>
        </tbody>
    </table>

    <h2>Exemplos de URLs</h2>
    <pre><code>
/api/v1/jobs?tags=Paperhanger,Forensic Investigator
/api/v1/jobs?salary_min=60000&salary_max=80000
/api/v1/jobs?location=Remote
/api/v1/jobs?featured=1
/api/v1/jobs?title=Analyst
/api/v1/jobs?employer=Smith
/api/v1/jobs?tags=Paperhanger&salary_min=60000&location=Remote&featured=1&title=Analyst&employer=Smith&per_page=5&page=2
    </code></pre>

    <h2>Exemplo de resposta paginada</h2>
    <pre><code>{
  "total": 25,
  "per_page": 5,
  "current_page": 2,
  "last_page": 5,
  "data": [
    {
      "id": 18,
      "title": "Financial Analyst",
      "salary": "$60,000",
      "location": "Remote",
      "schedule": "Part Time",
      "url": "http://www.thompson.org/",
      "featured": 1,
      "employer": {
        "id": 18,
        "name": "Medhurst, Smith and Thompson",
        "logo": "https://via.placeholder.com/640x480.png/0011aa?text=praesentium"
      },
      "tags": [
        {"id": 1, "name": "Paperhanger"},
        {"id": 2, "name": "Political Science Teacher"},
        {"id": 3, "name": "Forensic Investigator"}
      ]
    }
  ]
}</code></pre>

</body>
</html>