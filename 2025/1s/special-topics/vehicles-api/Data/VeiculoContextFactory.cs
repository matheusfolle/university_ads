using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Design;
using ApiCadastrarVeiculo.Data;

namespace ApiCadastrarVeiculo.Data
{
    public class VeiculoContextFactory : IDesignTimeDbContextFactory<VeiculoContext>
    {
        public VeiculoContext CreateDbContext(string[] args)
        {
            var optionsBuilder = new DbContextOptionsBuilder<VeiculoContext>();
            optionsBuilder.UseSqlite("Data Source=veiculos.db");

            return new VeiculoContext(optionsBuilder.Options);
        }
    }
}
