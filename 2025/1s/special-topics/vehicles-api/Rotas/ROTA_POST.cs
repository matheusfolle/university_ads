using ApiCadastrarVeiculo.Models;
using ApiCadastrarVeiculo.Data;
using Microsoft.AspNetCore.Mvc;

namespace ApiCadastrarVeiculo.Rotas
{
    public static class ROTA_POST
    {
        public static void MapPostRoutes(this WebApplication app)
        {
            app.MapPost("/api/veiculos", async ([FromBody] Veiculo veiculo, VeiculoContext db) =>
        {
            db.Veiculos.Add(veiculo);
            await db.SaveChangesAsync();
            return Results.Created($"/api/veiculos/{veiculo.Id}", veiculo);
        }).DisableAntiforgery();
        }
    }
}