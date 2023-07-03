let tblUsuarios, tblClientes,tblSucursal, tblTransportista, tblAsignacion,
 tblRoles, t_historial_c, t_historial_vi, tipo;
let frm = document.getElementById('formulario');
let eliminar = document.getElementById('btnEliminar');
document.addEventListener("DOMContentLoaded", function () {
    if ( document.getElementById('my_modal')){
        myModal = new bootstrap.Modal(document.getElementById('my_modal'));
    }

   


    
    $("#cliente").select2();
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'usuario'},
            {'data' : 'nombre'},
            {'data' : 'rol'},
       

        ]
    } );

    tblRoles = $('#tblRoles').DataTable( {
        ajax: {
            url: base_url + "Roles/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'nombre'},
            {'data' : 'estado'},
            {'data' : 'acciones'}

        ]
    } );

    
    tblClientes = $('#tblClientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'dni'},
            {'data' : 'nombre'},
            {'data' : 'telefono'},
            {'data' : 'direccion'}
           

        ]
    } );
    tblSucursal = $('#tblSucursal').DataTable( {
        ajax: {
            url: base_url + "Sucursales/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'sucursal'},
            {'data' : 'direccion'},
          

        ]
    } );




     // Tabla Transportista
     tblTransportista = $('#tblTransportista').DataTable( {
        ajax: {
            url: base_url + "Transportista/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'nombre'},
            {'data' : 'telefono'}

        ]
    } );


       // Tabla Asignacion
       tblAsignacion = $('#tblAsignacion').DataTable( {
        ajax: {
            url: base_url + "Asignaciones/listar" ,
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'Colaborador'},
            {'data' : 'Sucursal'},
            {'data' : 'distancia'}

        ]
    } );

    
       // Tabla Viajes
       
  
 
       t_historial_vi= $('#t_historial_vi').DataTable( {
        ajax: {
            url: base_url + "Viajes/listar_historial_viaje",
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'nombre'},
            {'data' : 'id_sucursal'},
            {'data' : 'tarifa_total'},
            {'data' : 'fecha'},


        ]
    } );
    
})




function frmUsuario() {
    document.getElementById("title").innerHTML="Registrar usuario";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
   
    const rol = document.getElementById("rol");

    if (usuario.value == "" || nombre.value == "") {
        Swal.fire({
          
            icon: 'error',
            title: 'Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                     
                        icon: 'success',
                        title: 'Usuario registrado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                  tblUsuarios.ajax.reload();
                }else if (res == "modificado") {
                    Swal.fire({
                        
                        icon: 'success',
                        title: 'Usuario modificado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    $("#nuevo_usuario").modal("hide");
                  tblUsuarios.ajax.reload();
                    
                }else{
                    Swal.fire({
                       
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                }
            }
        }
    }


}

////Fin Usuario
function frmCliente() {
    document.getElementById("title").innerHTML="Nuevo Colaborador";
    document.getElementById("btnAccion").innerHTML="Registrar";
    
        document.getElementById("frmCliente").reset();
        $("#nuevo_Cliente").modal("show");
    document.getElementById("id").value = "";
}

function registrarCli(e) {
    e.preventDefault();
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
  

    if (dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "" ) {
        Swal.fire({
          
            icon: 'error',
            title: 'Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                     
                        icon: 'success',
                        title: 'Cliente registrado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    $("#nuevo_Cliente").modal("hide");
                   tblClientes.ajax.reload();
                    
                }else if (res == "modificado") {
                    Swal.fire({
                        
                        icon: 'success',
                        title: 'Cliente modificado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                  tblClientes.ajax.reload();
                  $("#nuevo_Cliente").modal("hide");
                   
                }else{
                    Swal.fire({
                       
                        icon: res.icono,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                }
            }
        }
    }


}




///Fin cliente

function frmSucursal() {
    document.getElementById("title").textContent = "Nueva Sucuarsal";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmSucursal").reset();
    document.getElementById("id").value = "";
    $('#nuevoSucursal').modal('show');

}
function registrarSucursal(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const direccion = document.getElementById("direccion");
    if (nombre.value == "" || direccion.value == "") {
        Swal.fire({
          
            icon: 'error',
            title: 'Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + "Sucursales/registrar";
        const frm = document.getElementById("frmSucursal");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                     
                        icon: 'success',
                        title: 'Sucursal registrada correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    $("#nuevoSucursal").modal("hide");
                   tblSucursal.ajax.reload();                    
                }else if (res == "modificado") {
                    Swal.fire({
                        
                        icon: 'success',
                        title: 'Sucursal modificado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    $("#nuevoSucursal").modal("hide");
                    tblSucursal.ajax.reload();
                   
                }else{
                    Swal.fire({
                       
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                }
            }
        }
    }
}


//Fin Sucursal





//--------------------------------------------------------------------------------------------------------------
//Comienzo Transportista
function frmTransportista() {
    document.getElementById("title").innerHTML="Nuevo Transportista";
    document.getElementById("btnAccion").innerHTML="Registrar";
    document.getElementById("frmTransportista").reset();
          document.getElementById("id").value = ""; 
        $("#nuevo_Transportista").modal("show");
     

 
}

function registrarTransportista(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    
    if ( nombre.value == "" || telefono.value=="" ) {
        Swal.fire({
          
            icon: 'error',
            title:'¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + "Transportista/registrar";
        const frm = document.getElementById("frmTransportista");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                     
                        icon: 'success',
                        title: 'Transportista registrado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    $("#nuevo_Transportista").modal("hide");
                   tblTransportista.ajax.reload();
                    
                }else if (res == "modificado") {
                    Swal.fire({
                        
                        icon: 'success',
                        title: 'Transportista modificado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                  tblTransportista.ajax.reload();
                  $("#nuevo_Transportista").modal("hide");
                   
                }else{
                    Swal.fire({
                       
                        icon: res.icono,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                }
            }
        }
    }


}

  






// fin Transportista

//// Asignacion
///------------Asignaciones-----------

function frmAsignacion() {
    document.getElementById("title").innerHTML="Nueva Asignacion";
    document.getElementById("btnAccion").innerHTML="Registrar";
        document.getElementById("frmAsignacion").reset();
          document.getElementById("id").value = ""; 
        $("#nuevo_asignacion").modal("show");
     

 
}



function registrarAsignacion(e) {
    e.preventDefault();
    const sucursal = document.getElementById("sucursales");
    const colaborador = document.getElementById("colaborador");
    const distancia = document.getElementById("distancia");
    const tarifa = document.getElementById("tarifa");

    if (sucursal.value == "" || colaborador.value == "" || distancia.value == "" || tarifa.value == "") {
      Swal.fire({
        icon: 'error',
        title: '¡Todos los campos son obligatorios!',
        showConfirmButton: false,
        timer: 3000
      });
    } else {
      const url = base_url + "Asignaciones/registrar";
      const frm = document.getElementById("frmAsignacion");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "si") {
            Swal.fire({
              icon: 'success',
              title: 'Asignación registrada correctamente',
              showConfirmButton: false,
              timer: 3000
            });
          //  frm.reset();
            $("#nuevo_asignacion").modal("hide");
            //window.location.reload();
            tblAsignacion.ajax.reload();   
          } else {
            Swal.fire({
              icon: 'error',
              title: res,
              showConfirmButton: false,
              timer: 3000
            });
          }
        }
      };
    }
  }
  
//--------------------------------------------------------------------------------------------------------------



////Cargar colaboradores

function cargarColaboradores() {
    var sucursalSelect = document.getElementById("sucursales");
    var sucursalId = sucursalSelect.value;
    var url = base_url + "Viajes/getColaboradoresBySucursal/" + sucursalId;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var colaboradores = JSON.parse(xhr.responseText);
                var colaboradorSelect = document.getElementById("colaborador");
                colaboradorSelect.innerHTML = "";

                if (colaboradores.length > 0) {
                    colaboradores.forEach(colaborador => {
                        var option = document.createElement("option");
                        option.value = colaborador.id;
                        option.text = colaborador.nombre;
                        colaboradorSelect.appendChild(option);
                    });
                    
                    // Establecer la primera opción como seleccionada
                    colaboradorSelect.selectedIndex = 0;
                    
                    // Mostrar los datos correspondientes a la primera opción
                    mostrarDisTa();
                } else {
                    console.error("No se encontraron colaboradores para la sucursal seleccionada.");
                }
            } else {
                console.error("Error en la solicitud:", xhr.status);
            }
        }
    };

    xhr.open("GET", url, true);
    xhr.send();
}



/// Mostrar distancia y tarifa
function mostrarDisTa() {
    var colaborador = document.getElementById("colaborador").value;
    var sucursal = document.getElementById("sucursales").value;
    var url = base_url + "Viajes/buscarDatos?sucursal=" + sucursal + "&colaborador=" + colaborador;
  
    var http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        try {
          var res = JSON.parse(this.responseText);
          if (res.length > 0) {
            document.getElementById("distancia").value = res[0].distancia;
            document.getElementById("tarifa").value = res[0].tarifa;
          }
        } catch (error) {
          console.log("Error al analizar el JSON:", error);
        }
      }
    };
  }
  

/// Viajes
function registrarViaje(e) {
    e.preventDefault();
    const suc = document.getElementById("sucursales").value;
    const cola = document.getElementById("colaborador").value;
    const dist = document.getElementById("distancia").value;
    const tari = document.getElementById("tarifa").value;
  
    if (suc === "" || cola === "" || dist === "" || tari === "") {
      Swal.fire({
        icon: 'error',
        title: '¡Todos los campos son obligatorios!',
        showConfirmButton: false,
        timer: 3000
      });
      return;
    }
  
    const url = base_url + "Viajes/ingresar";
    const frm = document.getElementById("frmViajes");
    const formData = new FormData(frm);
  
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(formData);
  
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == 'ok') {
          Swal.fire({
            icon: 'success',
            title: '¡Viaje Ingresado!',
            showConfirmButton: false,
            timer: 2000
          });


          window.location.reload();

          cargarDetalleViaje();
        } else if (res == 'existe') {
          Swal.fire({
            icon: 'error',
            title: '¡Ya existe o ha seleccionado otra sucursal!',
            showConfirmButton: false,
            timer: 2000
          });
         
        } else {
          console.log(this.responseText);
          Swal.fire({
            icon: 'error',
            title: '¡Error al insertar el viaje!',
            showConfirmButton: false,
            timer: 2000
          });
          
        }
      }
    };
  }
  
  
  
  ////Procesar Viaje
  function procesarViaje() {
    const id_transportista = document.getElementById('transportistas').value;
    if (!id_transportista) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debe seleccionar un transportista.'
        });
        return;
    }
    const url = base_url + "Viajes/registrarViaje/" + id_transportista;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.msg == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'El viaje se ingresó correctamente.'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.msg
                }).then(() => {
                    window.location.reload();
                });
            }
        }
    }
}






function cargarDetalleViaje() {


    const url = base_url + "Viajes/listar/temp_viajes";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          let html = '';
          res.temp_viajes.forEach(row => {
              html += `<tr>
              <td>${row['sucursal']}</td>
              <td>${row['colaborador']}</td>
              <td>${row['distancia']}</td>
              <td>${row['tarifa']}</td>
              </tr>`;
    
          });
          document.getElementById("tblViajes").innerHTML = html;
          
    
        }
    }
    }
    if (document.getElementById('tblViajes')) {
        cargarDetalleViaje();
    }
    





function calcularDescuento(e, id){
    e.preventDefault();
    if (e.target.value==''){
        alertas('Ingrese el descuento', 'warning');
    }else{
        if (e.which==13){
            const url= base_url + "Compras/calcularDescuento/" + id + "/" + e.target.value;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText); 
                alertas(res.msg, res.icono);
                cargarDetalleVenta();
                }
            }        
         }      

    }
}







//-------------------------------------------------------------------------------------
//Permisos


function registrarPermisos(e){
    e.preventDefault();
    const url = base_url + "Roles/registrarPermisos" ;
    const frm = document.getElementById('formulario');
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            if(res != ''){
            
                alertas(res.msg , res.icono);
            }
            else{
                alertas('Error no identificado', 'error'); 
            }
        }
    }
}


//Roles
function frmRol() {
    document.getElementById("title").innerHTML="Nuevo Rol";
    document.getElementById("btnAccion").innerHTML="Registrar";
     document.getElementById("frmRol").reset();
          document.getElementById("id").value = ""; 
        $("#nuevo_Rol").modal("show");
     

 
}

function registrarRol(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    
    if ( nombre.value == "" ) {
        Swal.fire({
          
            icon: 'error',
            title:'¡Todos los campos son obligatorios!',
            showConfirmButton: false,
            timer: 3000
        })
    }else{
        const url = base_url + "Roles/registrar";
        const frm = document.getElementById("frmRol");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                     
                        icon: 'success',
                        title: 'Rol registrado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                    frm.reset();
                    $("#nuevo_Rol").modal("hide");
                   tblRoles.ajax.reload();
                    
                }else if (res == "modificado") {
                    Swal.fire({
                        
                        icon: 'success',
                        title: 'Rol modificado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    }) 
                  tblRoles.ajax.reload();
                  $("#nuevo_Rol").modal("hide");
                   
                }else{
                    Swal.fire({
                        icon: res.icono,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 3000
                        
                    }) 
                }
            }
        }
    }


}


function alertas(mensaje, icono){
    Swal.fire({
                
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
        }) 

}










