swal
  .fire({
    title: "Datos registrados correctamente",
    icon: "success",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  })
  .then((result) => {
    console.log("OK");
  });

