
function voteClick(id, type){

fetch( '/articles/' + id + '/vote/' + type,{method:'post'})
    .then((data)=>data.text())
    .then((data)=>document.getElementById('voteCount'+id).innerHTML = data);

}

