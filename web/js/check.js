    let checkCustomOption = document.getElementById('check');
    let customOption = document.getElementById('custom-option');
    checkCustomOption.addEventListener('click', function(){
        if(this.checked){
            customOption.classList.remove('d-none');
        }else{
            customOption.classList.add('d-none');
        }
    } );