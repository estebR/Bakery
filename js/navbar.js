fetch('/components/navbar.html?cache=' + new Date().getTime())
  .then(res => res.text())
  .then(html => {
    document.getElementById('navbar-container').innerHTML = html;
  });
