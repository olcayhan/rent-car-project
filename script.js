var cityChosen = document.getElementById('city-text')
var dateBegin = document.getElementById('date-begin')
var datefinish = document.getElementById('date-finish')
var searchBtn = document.getElementById('search')

let database;


const fetchData = async () => {
    try {
        let res = await fetch("./database.json");
        return await res.json();
    } catch (error) {
        console.log(error);
    }

}


const showCities = (data) => {
    let newListItem = document.createElement('li');
    newListItem.innerHTML = data.city;
    newListItem.className = 'city'
    newListItem.style.padding = '10px';
    newListItem.style.cursor = "pointer";
    document.getElementById('city-select').appendChild(newListItem)
}


const SelectCity = () => {
    document.querySelectorAll('.city').forEach((city) => {
        city.addEventListener('click', () => {
            cityChosen.innerHTML = city.innerHTML;
        })
    })
}

const getData = (data) => {
    database = data?.products
    data?.products.forEach((data) => {
        showCities(data)
        SelectCity()
        let date = new Date()
        dateBegin.value = date.toJSON().slice(0, 10); //get current date
        datefinish.value = new Date(date.getTime() + 7 * 24 * 60 * 60 * 1000).toJSON().slice(0, 10) // get one week later date
        dateBegin.max = datefinish.value
        datefinish.min = dateBegin.value
    })
}

const searchCars = () =>{
    document.querySelector(".all-cars").innerHTML = ""

    let chosen = database.find((item) => item.city == cityChosen.innerHTML)
    let beginDate = new Date(dateBegin.value)
    let finishDate = new Date(datefinish.value)
    let rentDay = 0;

    var Difference_In_Time = finishDate.getTime() - beginDate.getTime();
    rentDay = Difference_In_Time / (1000 * 3600 * 24);

    chosen.cars.forEach((item) => {
        document.querySelector(".all-cars").innerHTML += `
        <div class="car row" >
            <img src="${item?.img}" alt="" class="col-lg-3"/>
            <div class="col-lg">
                <h3>${item.name}</h3>
                <p>Year : ${item.year}</p>
                <p>Model : ${item.model}</p>
            </div>
            <div class="col-lg">
                <p>Price : ${item.price}₺/day<p>
                <p>Total price: ${item.price * rentDay}₺ / ${rentDay} day</p>
            </div>
            <button class="btn btn-outline-dark col-lg-1">Rent</button>
        </div >
    `
    })
}




fetchData().then((data) => getData(data))





