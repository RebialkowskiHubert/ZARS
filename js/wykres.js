/**
 * Generuje wykres
 * @author Hubert Rębiałkowski
 * @version 1.0
 * @requires Chart.min.js
 * @param {string} wykres - id elementu canvas, w którym wygenerować ma się wykres
 * @param {string} typ - typ wykresu (bar - słupkowy, line - liniowy, pie - kołowy)
 * @param {string[]} osX - argumenty znajdujące się na osi X
 * @param {double[][]} osY - tablica przechowująca wartości danych wykresów
 * @param {string} tytul - tytuł wykresu
 * @param {string[]} etykieta - etykieta dla danych osi Y wykresu
 * @returns {Chart} - wygenerowany wykres
 */
function zrobWykres(wykres, typ, osX, osY, tytul, etykieta){
    if(tytul==null)
        tytul='';
    
    let legenda;
    if(etykieta==null)
        legenda=false;
    else
        legenda=true;

    let kolory1 = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    let kolory2 = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    let ctx = document.getElementById(wykres).getContext('2d');

    let dane=[];
    
    for(var i=0; i<osY.length; i++){
        dane[i] = {label: etykieta[i], data: osY[i], backgroundColor: kolory1[i], borderColor: kolory2[i], borderWidth: 1};
    }

    let tenWykres = new Chart(ctx, {
        type: typ,
        data:{
            labels:osX,
            datasets:dane
        },
    
        options:{
            responsive: true,
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero: true
                    }
                }]
            },
            title:{
                display: true,
                text: tytul
            },
    
            legend:{
                display: legenda
            }
        }
    });

    return tenWykres;
}

let x = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"];
let y = [[12, 19, 3, 5, 2, 3], [1, 2, 3, 4, 5, 6]];
let etykieta = ['wartosci', 'cos innego'];
let tytul = 'III';

zrobWykres('myChart', 'bar', x, y, tytul, etykieta)