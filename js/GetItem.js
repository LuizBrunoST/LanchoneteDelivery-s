var total = 0;
var i = 0;
var valor = 0;

for(i=1; i<=99; i++){
    var prod = localStorage.getItem("produto" + i + "");
    if(prod != null){
        // exibe os dados da lista dentro da div itens
        document.getElementById("itens").innerHTML += localStorage.getItem("qtd" + i) + " | ";
        document.getElementById("itens").innerHTML += localStorage.getItem("produto" + i);
        document.getElementById("itens").innerHTML += " ";
        document.getElementById("itens").innerHTML += "R$: " + localStorage.getItem("valor" + i)+" ";

        // calcula o total dos recheios
        valor = parseFloat(localStorage.getItem("valor" + i)); // valor convertido com o parseFloat()
        total = (total + valor); // arredonda para 2 casas decimais com o .toFixed(2)
    }
}
document.getElementById("total").innerHTML += total.toFixed(2);