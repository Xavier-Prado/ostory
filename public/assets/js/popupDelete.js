
buttonElements = document.querySelectorAll('.btn-delete');
buttonElements.forEach((element) => {
    element.addEventListener('click', (e) => getUserResponse(e))
}); 


buttonDeleteElement = document.getElementById('delete');
buttonDeleteElement.addEventListener('click', togglePopup);

window.addEventListener('click', function(e){
    if (!document.getElementById('delete_button').contains(e.target) && e.target.id != 'delete'){
        popupWindow = document.getElementById('delete_button');
        popupWindow.classList.add('d-none');
    }
})

// crée un span caché pour y stocker la réponse
function getUserResponse(e) {
    formElement = document.querySelector('#confirmDelete');
    if(e.target.value == 'true' && formElement) formElement.submit();
    else togglePopup();
}

function togglePopup(){
    popupWindow = document.getElementById('delete_button');
    popupWindow.classList.toggle('d-none');
}



