document.addEventListener('DOMContentLoaded', () => 
{

    const form = document.getElementById('registration-form');
    const errorMessage =  document.getElementsByClassName("error-status")[0], errors = [];

    function checkPassword(str)
    {
        var re = /^(?=.*[~`!@#$%^&*()--+={}\[\]|\\:;"'<>,.?/_₹]).*$/;
        console.log(re.test(str));
        return re.test(str);
    }

    const translate = Array.from(document.getElementsByClassName("trsl") );
    const id = document.querySelector('#id')

    const rusLower = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'
    const rusUpper = rusLower.toUpperCase()
    const enLower = 'abcdefghijklmnopqrstuvwxyz'
    const enUpper = enLower.toUpperCase()
    const rus = rusLower + rusUpper
    const en = enLower + enUpper

    const getChar = (event) => String.fromCharCode(event.keyCode || event.charCode)
    
    translate.forEach(elem => {
        elem.addEventListener('keypress', function (e) 
        {
            const char = getChar(e)
            if (rus.includes(char) ) {
                id.innerHTML = 'Раскладка: ru'
            } else if (en.includes(char)) {
                id.innerHTML = 'Раскладка: en'
            } else {
                id.innerHTML = 'Раскладка: NULL'
            }
        })
    })

    const formHandler = (event) => 
    {
        event.preventDefault()
        
        const formData = new FormData( event.target );
        
        /* TODO: Обработка формы */
        
        if(formData.get("reg_login") == "" || formData.get("reg_password") == "")
        {
            errorMessage.innerHTML = "Поля не могут быть пустыми!";
            return;
        }

        if(formData.get("reg_password").length < 4)
        {
            errorMessage.innerHTML = "Пароль должен содержать не менее 4 символов!";
            return;
        }
        
        if(!checkPassword(formData.get("reg_password") ) )
        {
            errorMessage.innerHTML = "Пароль должен содержать хотя-бы 1 специальный символ! (@#$%)"
            return;
        }

        fetch('/db/register/register.php', 
        {
            method: "POST",
            header: {
                "Content-Type": "application/json; charset=utf-8"
            }, 
            body: formData,
        }).then(function(response) {
            return response.text();
        }).then(function(data) {
            console.log(data);
        });

        window.location.href = '../';
    }
      
    form.addEventListener('submit', formHandler);
})