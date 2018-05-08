(function () {
    'use strict';
    var form = document.getElementById('form');
    form.addEventListener('submit', submitForm);
    
    function submitForm(event) {
        event.preventDefault();        
        if(checkForm()) {
            form.submit();
        }
    }
    
    var login = document.getElementById('login');
    var password = document.getElementById('password');
    
    function checkForm() {
        var reg_login =  /[a-zA-Z]{1}\w{3,19}/; // alinaka
        var reg_pwd = /(?=.{9,})(?=(.*\d){2,})(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/g; // 4Tq3Xc5A!
            if (login.value.match(reg_login) && password.value.match(reg_pwd)){
                console.log('подходит');
                return 1;
            } else if (password.value.match(reg_pwd)) {
                alert('Логин должен состоять от 4 до 20 символов, и не должен начинаться с цифры');
                return 0;
            } else {
                alert(`Пароль должен удовлетворять следующим требованиям:
	                       - длина от 9 символов;
	                       - содержит обязательно только латинские буквы верхнего и нижнего регистра;
	                       - содержит более двух цифр;
	                       - содержит обязательно один из неалфавитных символов (например, !, $, #, %).'`);
                return 0;
            }
    }   
}());