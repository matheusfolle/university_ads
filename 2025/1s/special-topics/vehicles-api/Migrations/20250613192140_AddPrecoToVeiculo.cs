using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ApiCadastrarVeiculo.Migrations
{
    /// <inheritdoc />
    public partial class AddPrecoToVeiculo : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<decimal>(
                name: "Preco",
                table: "Veiculos",
                type: "TEXT",
                nullable: false,
                defaultValue: 0m);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Preco",
                table: "Veiculos");
        }
    }
}
