using ApiCadastrarVeiculo.Data;
using ApiCadastrarVeiculo.Models;

namespace ApiCadastrarVeiculo.Rotas
{
    public static class ROTA_DELETE
    {
        public static void MapDeleteRoutes(this WebApplication app)
        {
            app.MapDelete("/api/veiculos/{id}", async (int id, VeiculoContext db) =>
            {
                var veiculo = await db.Veiculos.FindAsync(id);
                if (veiculo == null)
                    return Results.NotFound();

                db.Veiculos.Remove(veiculo);
                await db.SaveChangesAsync();

                return Results.NoContent();
            });
        }
    }
}
