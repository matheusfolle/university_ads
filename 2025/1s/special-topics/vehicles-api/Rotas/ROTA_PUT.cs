using ApiCadastrarVeiculo.Data;
using ApiCadastrarVeiculo.Models;
using Microsoft.AspNetCore.Mvc;

namespace ApiCadastrarVeiculo.Rotas
{
    public static class ROTA_PUT
    {
        public static void MapPutRoutes(this WebApplication app)
        {
            app.MapPut("/api/veiculos/{id}", async (int id, [FromBody] Veiculo novoVeiculo, VeiculoContext db) =>
{
            var veiculoExistente = await db.Veiculos.FindAsync(id);
            if (veiculoExistente == null)
                return Results.NotFound();

            veiculoExistente.Modelo = novoVeiculo.Modelo;
            veiculoExistente.Marca = novoVeiculo.Marca;
            veiculoExistente.Cor = novoVeiculo.Cor;
            veiculoExistente.Placa = novoVeiculo.Placa;
            veiculoExistente.Chassis = novoVeiculo.Chassis;
            veiculoExistente.Status = novoVeiculo.Status;

            await db.SaveChangesAsync();
            return Results.Ok(veiculoExistente);
        });
        }
    }
}