let addLinks = document.querySelectorAll('#add-panier');
let request = new XMLHttpRequest();
for (let i = 0; i < addLinks.length; i++) {
    addLinks[i].addEventListener('click', function (event) {
        event.preventDefault();
        let url = this.getAttribute('href');
        // AJAX REQUEST
        request.open('GET', url, true);
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                addLinks[i].classList.remove('btn-secondary');
                addLinks[i].classList.add('btn-success');
                addLinks[i].innerHTML = 'Ajouté au panier!';
            }
        };
        request.send();
    });
}

let delLinks = document.querySelectorAll('#del-panier');
for (let k = 0; k < delLinks.length; k++) {
    delLinks[k].addEventListener('click', function (event) {
        event.preventDefault();
        let url = this.getAttribute('href');
        // AJAX REQUEST
        request.open('GET', url, true);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    delLinks[k].parentElement.parentElement.remove();
                    let newTotal = JSON.parse(request.responseText);
                    document.querySelector('.badge-dark').innerHTML = 'Prix total : ' + newTotal + ' €';
                }
            }
        };
        request.send();
    });
}