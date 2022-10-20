@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <button class="btn btn-info" id="randomitem">Random</button>
        </div>
    </div>
    <div class="row" id="show_random">
            
    </div>
</div>
<script>
    let items = [];
    let showitem = [];
    let sumitem = [];
    let randomnum = 100;
    let posrandom = [];

    
    function resetitem()
    {
        return [
            { 'name' : 'Small Potion Heal' , 'chance' : 0.12 , 'stock' : 1000 },
            { 'name' : 'Medium Potion Heal' , 'chance' : 0.08 , 'stock' : 80 },
            { 'name' : 'Big Potion Heal' , 'chance' : 0.06 , 'stock' : 15 },
            { 'name' : 'Full Potion Heal' , 'chance' : 0.04 , 'stock' : 10 },
            { 'name' : 'Small MP Potion' , 'chance' : 0.12 , 'stock' : 1000 },
            { 'name' : 'Medium MP Potion' , 'chance' : 0.08 , 'stock' : 80 },
            { 'name' : 'Big MP Potion' , 'chance' : 0.06 , 'stock' : 15 },
            { 'name' : 'Full MP Potion' , 'chance' : 0.04 , 'stock' : 8 },
            { 'name' : 'Attack Ring' , 'chance' : 0.05 , 'stock' : 10 },
            { 'name' : 'Defense Ring' , 'chance' : 0.05 , 'stock' : 10 },
            { 'name' : 'Lucky Key' , 'chance' : 0.15 , 'stock' : 1000 },
            { 'name' : 'Silver Key' , 'chance' : 0.15 , 'stock' : 1000 }
        ];
    }

    function randomitem(index)
    {
        // thisrandom = Math.floor(Math.random() * items.length);
        let thisrandom = 0;
        thisrandom = Math.floor(Math.random() * randomnum);
        let thisindex = posrandom[thisrandom];

        if(parseInt(items[thisindex]['stock'])>=1)
        {
            items[thisindex]['stock'] = parseInt(items[thisindex]['stock'])-1;
            if (typeof sumitem[thisindex] !== 'undefined') {
                sumitem[thisindex]+=1;
            }
            else
            {
                sumitem[thisindex]=1;
            }
        }
        else
        {
            randomitem(index);
        }
        
        showitem[index] = (index+1)+'. '+items[thisindex]['name'];
    }

    document.querySelector("#randomitem").addEventListener('click', e => {
        items = resetitem();
        let crandom = 0;
        items.forEach(function(item,index){
            for (let x = 0; x < (item.chance*100); x++) {
                
                posrandom[crandom] = index;
                crandom++;
            }
        });

        showitem = [];
        sumitem = [];
        let thisrandom = 0;
        let html="";
        for (let index = 0; index < 100; index++) {
            randomitem(index);
        }

        let randomdiv = document.querySelector("#show_random");
        randomdiv.innerHTML = "<br><h2>Item Recieved</h2>";
        for (let index = 0; index < 100; index++) {
            randomdiv.innerHTML += "<div class='col-12'>"+showitem[index]+"</div>";
        }
        randomdiv.innerHTML += "<br><h2>Item Recieved Summary</h2>";
        for (let index = 0; index < items.length; index++) {
            randomdiv.innerHTML += "<div class='col-12'>"+items[index]['name']+" "+sumitem[index]+" EA"+"</div>";
        }
        randomdiv.innerHTML += "<br><h2>Stock Remaining</h2>";
        for (let index = 0; index < items.length; index++) {
            randomdiv.innerHTML += "<div class='col-12'>"+items[index]['name']+" Stock : "+items[index]['stock']+"</div>";
        }
    });
</script>
@endsection