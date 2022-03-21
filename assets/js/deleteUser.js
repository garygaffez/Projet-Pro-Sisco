let usersList = document.getElementById('userslist');
let users = [];

function deleteUser(id) {
    fetch('../../controllers/liste-controller-ajax.php', {
        headers : {
            'content-type' : 'application/x-www-form-urlencoded',
        },
        method : 'POST',
        body : `ajaxDelete=true&id=${id}`
    }).then((response) => {
        return response.json();
    }).then((data) => {
        if (data.message){
            getAllUsersAjax();
        }

    })
}


// let search = document.getElementById('search');

// search.addEventListener('keyup', () =>{
//     let searchValue = search.value
//     getAllUsersAjax(searchValue);
// })


function getAllUsersAjax(search="") {

    fetch(`../../controllers/liste-controller-ajax.php?search=${search}`, {
        headers : {
            'content-type' : 'application/json',
        },
        method : 'GET', 
    }).then((response) => {
        return response.json();
    }).then((data) => {
        console.log(data);
        let listUser = "";
        usersList.innerText = "";
        data.map(user =>{
            listUser += 
            `
                <tr>
                    <td>${user.lastname}</td>
                    <td>${user.firstname}</td>
                    <td><a href="mailto:gary.gaffez@gmail.com">${user.mail}</td>
                    <td>${user.phone}</td>


                    <td>
                        <a href="/controllers/update-user-controller.php?id=${user.id_user}"
                            class="">Modifier</a>
                    </td>
                    <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#user_${user.id_user}"><img src="/assets/img/delete-1-icon.png" class="img-thumbnail"alt=""></button>
                    </td>

                </tr>


                <div class="modal fade" id="user_${user.id_user}" tabindex="-1" aria-labelledby="${user.id_user}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title_${user.id_user}">Voulez-vous supprimer ${user.lastname} ${user.firstname} ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="deleteUser(${user.id_user})">Continuer</button>
                        </div>
                        </div>
                    </div>
                </div>
            `
            
        });
        usersList.innerHTML = listUser;
    })
}

getAllUsersAjax();





// setInterval(getAllUsersAjax, 1500);

