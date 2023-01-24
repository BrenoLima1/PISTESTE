document.getElementById("reservar").addEventListener("click", async (event) => {
  event.preventDefault();
  reserva();
});

async function reserva(event) {
  let formData = new FormData(document.querySelector("form"));
  for (const input of document.querySelectorAll("input")) {
    if (!input.value) {
      alert("Todos os campos devem ser preenchidos.");
      return;
    }
  }

  fetch("http://localhost/pisp3/2022-2-pis-pf-breno/api/reservas", {
    method: "POST",
    body: formData,
  })
    .then(async (resposta) => {
      if (!resposta.ok) {
        const output = document.querySelector("output");
        output.innerText = "Erro: " + e.message;
      }
      alert("Reserva cadastrada");
    })
    .catch((e) => {
      document.querySelector("form").reset();
      const output = document.querySelector("output");
      output.innerText = "Erro: " + e.message;
    });
}
