fetch('listar.php')
.then(res => res.json())
.then(data => {

    // console.log(data);
    let str = '';
    data.map(item => {
        str += `
            <tr>
                <td>${item.id}</td>
                <td>${item.nombre} ${item.apellido}</td>
                <td>${item.edad} años</td>
                <td>${item.genero}</td>
                <td>${item.celular}</td>
                <td>${item.cargo}</td>
                <td>${ (item.habilitado == 1) ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>' }</td>
            </tr>
        `
    });

    document.getElementById('table_data').innerHTML = str;


});