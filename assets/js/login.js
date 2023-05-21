const formLogin = document.getElementById('formLogin');


formLogin.addEventListener('submit', async (event) => {
    event.preventDefault();

    const usuarioID = document.getElementById('usuarioID').value;
    const password = document.getElementById('password').value;

    const data = new URLSearchParams();
    data.append('usuarioID', usuarioID);
    data.append('password', password);
    axios.post('http://localhost/Tienda/login/login',data)
        .then((response) =>{

            const success = response.data.success;

            if(!success) {
                const alertDanger = document.getElementById('alert-danger');
                alertDanger.classList.remove('display-none');
                alertDanger.classList.remove('fadeOut');
                alertDanger.classList.add('fadeIn');
                setTimeout(() => {
                    alertDanger.classList.remove('fadeIn');
                    alertDanger.classList.add('fadeOut');
                },1500);
                setTimeout(() =>{
                    alertDanger.classList.add('display-none');
                },2000);
            } else {
                location.href = 'http://localhost/Tienda/';
            }

            console.log(response.data.success);
        });
    

});