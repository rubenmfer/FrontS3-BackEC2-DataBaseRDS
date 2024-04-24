fetch('listar.php')
.then(res => res.json())
.then(data => {

    // console.log(data);
    let str = '';
    data.map(item => {
        str += `
            <tr>
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>${item.email}</td>
                <td>${item.message}</td>
                <td>
                        <a class="btn btn-primary" onclick="actualizar(${item.id})">Editar</a>
                        <a class="btn btn-danger" onclick="eliminar(${item.id})">Eliminar</a>
                </td>
            </tr>
        `
    });


    document.getElementById('table_data').innerHTML = str;


});


const eliminar = (id) => {
//alert(id)
        var url = "eliminar.php";
        var formdata = new FormData();
        formdata.append('id',id);
        fetch(url, {
                method: 'post',
                body: formdata
        }).then(res => res.json())
        .then(response => {
                console.log('Success:', response)
        })
        .catch(error => console.error('Error:', error));

window.location.reload();
} //fin const




const actualizar = (id) => {

var url = "actualizar.php";
var formData = new FormData();
formData.append('id',id)
fetch(url,{
        method:'post',
        body:formData
})
.then(res => res.json())
.then(res => {
        console.log('success', res);







} //fin const actualizar
