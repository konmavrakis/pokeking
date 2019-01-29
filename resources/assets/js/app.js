const pokeking = document.getElementById('pokeking');
const pokeking_div = document.getElementById('pokeking-div');
const pokeking_link = '/pokeking';

pokeking.addEventListener('click', ()=>{
    fetch(pokeking_link, { headers: { "Content-Type": "application/json; charset=utf-8" }})
    .then(pokeking.innerHTML = 'Loading...')
    .then(res => res.json())
    .then(response => {
        pokeking.remove();
        const output = `
            <div class="nes-container with-title is-centered">
                <p class="title"><i class="nes-icon trophy is-small"></i>${response.name}<i class="nes-icon trophy is-small"></i></p>
                <p>
                    <img src="${response.image}"><br>
                    Sum of Base Stats: ${response.sum_of_stats}<br>
                    Height: ${response.height}<br>
                    Weight: ${response.weight}<br>
                </p>
            </div>
        `;
        pokeking_div.innerHTML = output;
    })
    .catch(err => {
        console.log(err);
        alert("sorry, something went wrong");
    });
})