function UserError(){
	let form = document.getElementById('form-login');
	form.classList.add('form-login-error');
	let mssg = document.getElementById('error-msg');
	mssg.removeAttribute('hidden');
	mssg.textContent = 'El Usuario no existe.';
	let icons = document.getElementsByClassName('icons');
	for(var i = 0; i < icons.length; i++){
	    icons[i].classList.add('icons-error');
	}
}

function PassError(){
	let form = document.getElementById('form-login');
	form.classList.add('form-login-error');
	let mssg = document.getElementById('error-msg');
	mssg.removeAttribute('hidden');
	mssg.textContent = 'Usuario o contraseña icorrectos';
	let icons = document.getElementsByClassName('icons');
	for(var i = 0; i < icons.length; i++){
	    icons[i].classList.add('icons-error');
	}
}