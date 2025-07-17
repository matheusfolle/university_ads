let idEditando = null;

async function carregarVeiculos() {
  const resposta = await fetch('/api/veiculos');
  const veiculos = await resposta.json();
  const tabela = document.getElementById('tabela-veiculos');
  tabela.innerHTML = '';

  veiculos.forEach(v => {
    const linha = `
      <tr>
        <td>${v.modelo}</td>
        <td>${v.marca}</td>
        <td>R$ ${parseFloat(v.preco).toFixed(2).replace('.', ',')}</td>
        <td>${v.cor}</td>
        <td>${v.placa}</td>
        <td>${v.chassis}</td>
        <td>${v.status}</td>
        <td class="col-acoes">
          <button class="btn-editar" onclick='editarVeiculo(${JSON.stringify(v)})'>Editar</button>
          <button class="btn-excluir" onclick="excluirVeiculo(${v.id})">Excluir</button>
        </td>
      </tr>`;
    tabela.innerHTML += linha;
  });
}

document.getElementById('btn-listar').addEventListener('click', carregarVeiculos);
carregarVeiculos();

document.querySelector("form").addEventListener("submit", async function (e) {
  e.preventDefault();

  const modelo = document.querySelector('input[name="modelo"]').value.trim();
  const marca = document.querySelector('input[name="marca"]').value.trim();
  const preco = parseFloat(document.querySelector('input[name="preco"]').value.trim());
  const cor = document.querySelector('input[name="cor"]').value.trim();
  const placa = document.querySelector('input[name="placa"]').value.trim();
  const chassis = document.querySelector('input[name="chassis"]').value.trim();
  const status = document.querySelector('input[name="status"]').value.trim();

  if (!modelo || !marca || isNaN(preco) || !cor || !placa || !chassis || !status) {
    alert("Por favor, preencha todos os campos corretamente.");
    return;
  }

  const dados = {
    modelo,
    marca,
    preco,
    cor,
    placa,
    chassis,
    status
  };

  let resposta;

  if (idEditando !== null) {
    resposta = await fetch(`/api/veiculos/${idEditando}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dados)
    });

    if (resposta.ok) {
      alert("Veículo atualizado com sucesso.");
      document.querySelector('button[type="submit"]').textContent = "Cadastrar";
      idEditando = null;
    } else {
      alert("Erro ao atualizar o veículo.");
    }
  } else {
    resposta = await fetch('/api/veiculos', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dados)
    });

    if (resposta.ok) {
      document.getElementById("mensagemCadastro").style.display = "block";
      setTimeout(() => {
        document.getElementById("mensagemCadastro").style.display = "none";
      }, 3000);
    } else {
      alert("Erro ao cadastrar o veículo.");
    }
  }

  carregarVeiculos();
  this.reset();
});

async function excluirVeiculo(id) {
  if (!confirm("Tem certeza que deseja excluir este veículo?")) return;

  const resposta = await fetch(`/api/veiculos/${id}`, {
    method: 'DELETE'
  });

  if (resposta.ok) {
    alert("Veículo excluído com sucesso.");
    carregarVeiculos();
  } else {
    alert("Erro ao excluir o veículo.");
  }
}

function editarVeiculo(veiculo) {
  document.querySelector('input[name="modelo"]').value = veiculo.modelo;
  document.querySelector('input[name="marca"]').value = veiculo.marca;
  document.querySelector('input[name="preco"]').value = veiculo.preco;
  document.querySelector('input[name="cor"]').value = veiculo.cor;
  document.querySelector('input[name="placa"]').value = veiculo.placa;
  document.querySelector('input[name="chassis"]').value = veiculo.chassis;
  document.querySelector('input[name="status"]').value = veiculo.status;

  idEditando = veiculo.id;
  document.querySelector('button[type="submit"]').textContent = "Atualizar";
}