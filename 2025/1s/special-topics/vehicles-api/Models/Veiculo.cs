namespace ApiCadastrarVeiculo.Models
{
    public class Veiculo
    {
        public int Id { get; set; }  
        public string Modelo { get; set; }
        public string Marca { get; set; }
        public decimal Preco { get; set; }
        public string Cor { get; set; }
        public string Placa { get; set; }
        public string Chassis { get; set; }
        public string Status { get; set; }
    }
}