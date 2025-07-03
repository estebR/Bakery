const http = require('http');
const fs = require('fs');
const mysql = require('mysql');
const path = require('path');

const server = http.createServer((req, res) => {
  if (req.method === 'GET') {

    let filePath = req.url === '/' ? 'Home.html' : req.url.slice(1);
    let extname = path.extname(filePath);

    let contentType = 'text/html';
    switch (extname) {
      case '.css': contentType = 'text/css'; break;
      case '.js': contentType = 'text/javascript'; break;
      case '.json': contentType = 'application/json'; break;
      case '.png': contentType = 'image/png'; break;
      case '.jpg':
      case '.jpeg': contentType = 'image/jpeg'; break;
      case '.ico': contentType = 'image/x-icon'; break;
    }

    fs.readFile(path.join(__dirname, filePath), (err, data) => {
      if (err) {
        res.writeHead(404, { 'Content-Type': 'text/plain' });
        return res.end('404 - File Not Found');
      }
      res.writeHead(200, { 'Content-Type': contentType });
      res.end(data);
    });

  } else if (req.method === 'POST') {
    let body = '';
    req.on('data', chunk => body += chunk);
    req.on('end', () => {
      const { full_name } = JSON.parse(body);
      // Ensure you have initialized db before using
      db.query('INSERT INTO names (full_name) VALUES (?)', [full_name]);
      res.end(JSON.stringify({ success: true }));
    });
  }
});

server.listen(3000, () => console.log('Running on port 3000'));
