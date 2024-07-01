fetch('./components/header.html?v=1')
.then(response => response.text())
.then(data => {
    document.getElementById('header').innerHTML = data;
})
.catch(error => console.error('Error loading HTML:', error));

fetch('./components/footer.html?v=1')
.then(response => response.text())
.then(data => {
    document.getElementById('footer').innerHTML = data;
})
.catch(error => console.error('Error loading HTML:', error));