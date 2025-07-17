using Microsoft.EntityFrameworkCore;
using ApiCadastrarVeiculo.Models;

namespace ApiCadastrarVeiculo.Data
{
    public class VeiculoContext : DbContext
    {
        public VeiculoContext(DbContextOptions<VeiculoContext> options) : base(options) { }

        public DbSet<Veiculo> Veiculos { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Veiculo>().HasKey(v => v.Id);

            // modelBuilder.Entity<Veiculo>().HasData(
            //     new Veiculo { Id = 1, Modelo = "Onix", Marca = "Chevrolet", Cor = "Prata", Placa = "ABC1234", Chassis = "CHS001", Status = "Roubado" },
            //     new Veiculo { Id = 2, Modelo = "Civic", Marca = "Honda", Cor = "Preto", Placa = "DEF5678", Chassis = "CHS002", Status = "Recuperado" },
            //     new Veiculo { Id = 3, Modelo = "Gol", Marca = "Volkswagen", Cor = "Branco", Placa = "GHI9012", Chassis = "CHS003", Status = "Roubado" },
            //     new Veiculo { Id = 4, Modelo = "Fiesta", Marca = "Ford", Cor = "Azul", Placa = "JKL3456", Chassis = "CHS004", Status = "Roubado" },
            //     new Veiculo { Id = 5, Modelo = "HB20", Marca = "Hyundai", Cor = "Vermelho", Placa = "MNO7890", Chassis = "CHS005", Status = "Recuperado" },
            //     new Veiculo { Id = 6, Modelo = "Ka", Marca = "Ford", Cor = "Cinza", Placa = "PQR1234", Chassis = "CHS006", Status = "Roubado" },
            //     new Veiculo { Id = 7, Modelo = "Palio", Marca = "Fiat", Cor = "Preto", Placa = "STU5678", Chassis = "CHS007", Status = "Recuperado" },
            //     new Veiculo { Id = 8, Modelo = "Corolla", Marca = "Toyota", Cor = "Branco", Placa = "VWX9012", Chassis = "CHS008", Status = "Roubado" },
            //     new Veiculo { Id = 9, Modelo = "Cruze", Marca = "Chevrolet", Cor = "Azul", Placa = "YZA3456", Chassis = "CHS009", Status = "Roubado" },
            //     new Veiculo { Id = 10, Modelo = "Uno", Marca = "Fiat", Cor = "Verde", Placa = "BCD7890", Chassis = "CHS010", Status = "Recuperado" }
            // );
        }
    }
}
