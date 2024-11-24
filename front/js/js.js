window.addEventListener('load', function() {
    
   
    const usuarios = document.getElementById('usuarios');
    const enviar = document.getElementById('enviar');

    // Llama a getUsers cada 5 segundos
    setInterval(() => {
        getUsers().then(users => {
            // Limpiar la lista antes de agregar los nuevos usuarios
            usuarios.innerHTML = '';

            // Asegúrate de que users es un array
            if (Array.isArray(users)) {
                // Recorre el array de usuarios
                users.forEach(user => {
                    // Crea un nuevo <li> por cada usuario
                    const li = document.createElement('li');
                    li.innerHTML = `${user.nombre} ${user.apellido} - ${user.oficio}`;
                    // Agrega el <li> a la lista de usuarios
                    usuarios.appendChild(li);
                });
                usuarios.style.display = 'block'; // Mostrar la lista
            } else {
                console.error('La respuesta no es un array');
            }
        });
    }, 10000); // 10000 milisegundos = 10 segundos

    enviar.addEventListener('click', async function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del botón
    
        const nombre = document.getElementById('nombre').value;
        const apellido = document.getElementById('apellido').value;
        const oficio = document.getElementById('oficio').value;
    
        // Llama a la función para añadir el usuario
        addUser(nombre, apellido, oficio);
    });




}); 


async function getUsers() {
    try {
        const response = await fetch('http://localhost:8081/Api_user.php');
        const data = await response.json();
        
        // Si la respuesta contiene un string JSON, lo parseamos
        const users = JSON.parse(data.user);  // Convertir el string JSON en un array
        console.log(users);  // Ahora es un array de objetos
        
        return users;
    } catch (error) {
        console.error('Error al obtener los usuarios:', error);
    }
}

async function addUser(nombre, apellido, oficio) {
    try {
        const response = await fetch('http://localhost:8081/Api_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre, apellido, oficio })
        });
        const data = await response.json();
        console.log(data);
        return data;

    } catch (error) {
        console.error('Error al agregar el usuario:', error);
    }
}