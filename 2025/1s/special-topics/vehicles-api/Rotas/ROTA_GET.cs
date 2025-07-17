using Microsoft.EntityFrameworkCore;
using ApiCadastrarVeiculo.Data;
using ApiCadastrarVeiculo.Models;

namespace ApiCadastrarVeiculo.Rotas
{
    public static class ROTA_GET
    {
        public static void MapGetRoutes(this WebApplication app)
        {
            app.MapGet("/api/veiculos", async (VeiculoContext db) =>
                await db.Veiculos.ToListAsync());

            app.MapGet("/api/veiculos/{id}", async (int id, VeiculoContext db) =>
                await db.Veiculos.FindAsync(id)
                    is Veiculo veiculo && veiculo != null
                        ? Results.Ok(veiculo)
                        : Results.NotFound());
        }
    }
}