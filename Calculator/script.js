function press(value)
{
    document.getElementById("display").value += value;
}

function calculate()
{
    try{
        var result = eval(document.getElementById("display").value);
        document.getElementById("display").value = result;
    }
    catch{
        alert("Invalid Input");
    }
}

function clearDisplay()
{
    document.getElementById("display").value = "";
}