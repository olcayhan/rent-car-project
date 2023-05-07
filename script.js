var cityChosen = document.getElementById('city-text')
var dateBegin = document.getElementById('date-begin')
var datefinish = document.getElementById('date-finish')
var searchBtn = document.getElementById('search')


let database = [
    {
        id: 1,
        city: 'New York',
        cars: [
            {
                id: 1,
                name: "Nissan Juke",
                img: "/assets/cars/nissan-juke.png",
                year: 2002,
                model: "Suv",
                price: 100
            },
            {
                id: 2,
                name: "Ford Courier",
                img: "/assets/cars/ford-courier.png",
                year: 2015,
                model: "Wagon",
                price: 230,
            },
        ]
    },
    {
        id: 2,
        city: 'Istanbul',
        cars: [
            {
                id: 3,
                name: "Toyota Auris",
                img: "/assets/cars/toyota-auris.png",
                year: 2018,
                model: "Compact Car",
                price: 260,
            }
        ]
    },
    {
        id: 3,
        city: 'London',
        cars: [
            {
                id: 4,
                name: "Opel Astra",
                img: "/assets/cars/opel-astra.png",
                model: "Compact Car",
                year: 2017,
                price: 270,
            }
        ]
    },
    {
        id: 4,
        city: 'Bursa',
        cars: [
            {
                id: 5,
                name: "Peugeot 208",
                img: "/assets/cars/peugeot-208.png",
                model: "Economy Car",
                year: 2016,
                price: 300,
            }
        ]
    },
    {
        id: 5,
        city: 'Letonya',
        cars: [
            {
                id: 6,
                name: "BMW 1 Series",
                img: "/assets/cars/bmw-1series.png",
                model: "Compact Elite Car",
                year: 2018,
                price: 850,
            }
        ]
    },
]


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


database.forEach((data) => {
    showCities(data)
    SelectCity()
    let date = new Date()
    dateBegin.value = date.toJSON().slice(0, 10); //get current date
    datefinish.value = new Date(date.getTime() + 7 * 24 * 60 * 60 * 1000).toJSON().slice(0, 10) // get one week later date
    dateBegin.max = datefinish.value
    datefinish.min = dateBegin.value
})


dateBegin.addEventListener('change', (e) => {
    console.log(e.target.value)
})

searchBtn.addEventListener('click', () => {
    document.querySelector(".all-cars").innerHTML = ""
    console.log(cityChosen.innerHTML)
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
})



