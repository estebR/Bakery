const form= document.getElementById('form')

form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const value = document.getElementById('itemInput').value;

      const response = await fetch('/add-item', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ item: value })
      });

      const data = await response.json();
      alert(data.success ? "Item saved!" : "Error: " + data.error);
    });