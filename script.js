var dateBegin = document.getElementById("date-begin");
var datefinish = document.getElementById("date-finish");


let date = new Date();
dateBegin.value = date.toJSON().slice(0, 10); //get current date
datefinish.value = new Date(date.getTime() + 7 * 24 * 60 * 60 * 1000)
  .toJSON()
  .slice(0, 10); // get one week later date
dateBegin.max = datefinish.value;
datefinish.min = dateBegin.value;

