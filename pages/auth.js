
const registerNewUser = () => {

    let users = []
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let error = document.getElementById('error');

    if (username.length === 0) {
        error.innerHTML = "Kullanıcı adı boş olamaz"
        return;
    }
    if (email.length === 0) {
        error.innerHTML = "E-mail boş olamaz"
        return;
    }
    if (password.length === 0) {
        error.innerHTML = "Parola boş olamaz"
        return;
    }

    let checkUser = users.filter((user) => user.email === email)
    if (checkUser.length !== 0) {
        error.innerHTML = "Bu Email Zaten Kullanılıyor"
        return;
    }


    users.push({
        username: username,
        email: email,
        password: password
    })


    localStorage.setItem("users", JSON.stringify(users))
    location.href = "/pages/login.html"
}


const validateUser = () => {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let error = document.getElementById('error');



    if (email.length === 0) {
        error.innerHTML = "E-mail boş olamaz"
        return;
    }
    if (password.length === 0) {
        error.innerHTML = "Parola boş olamaz"
        return;
    }

    let users = JSON.parse(localStorage.getItem('users'));
    let checkUser = users.find((user) => user.email === email)


    if (checkUser.length === 0) {
        error.innerHTML = "Kullanıcı Bulunamadı"
        return;
    }
    console.log(checkUser.password, password)
    if (checkUser.password !== password) {
        error.innerHTML = "Parola Yanlış"
        return;
    }
    alert("giriş başarılı")
    localStorage.setItem("users", JSON.stringify(checkUser))
    location.href = "/"
}



