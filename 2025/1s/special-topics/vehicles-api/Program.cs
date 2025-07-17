using ApiCadastrarVeiculo.Data;
using ApiCadastrarVeiculo.Models;
using ApiCadastrarVeiculo.Rotas;
using Microsoft.EntityFrameworkCore;
using SQLitePCL;

Batteries_V2.Init();

var builder = WebApplication.CreateBuilder(args);

builder.Services.AddDbContext<VeiculoContext>(opt =>
    opt.UseSqlite("Data Source=veiculos.db"));

builder.Services.AddCors(options =>
{
    options.AddPolicy("PermitirTudo", policy =>
    {
        policy.AllowAnyOrigin()
              .AllowAnyMethod()
              .AllowAnyHeader();
    });
});

var app = builder.Build();

app.UseCors("PermitirTudo");

app.UseDefaultFiles();
app.UseStaticFiles();

app.MapGetRoutes();
app.MapPostRoutes();
app.MapDeleteRoutes();
app.MapPutRoutes();

app.Run();