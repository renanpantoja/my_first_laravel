<h1>Nova vaga publicada!</h1>

<p>Olá {{ $job->employer->name }},</p>

<p>Sua nova vaga <strong>{{ $job->title }}</strong> foi criada com sucesso.</p>
<p>Local: {{ $job->location }}</p>
<p>Salário: {{ $job->salary }}</p>
<a href="{{ $job->url }}">View your Job Listing</a>