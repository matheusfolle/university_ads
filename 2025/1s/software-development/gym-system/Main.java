import controller.*;
import dal.CustomerDAO;
import dal.ExerciseDAO;
import dal.TrainingDAO;
import model.Customer;
import model.Exercise;
import model.Training;
import view.*;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        List<Customer> customerList;
        List<Exercise> exercisesList;
        List<Training> trainingList;

        try {
            customerList = CustomerDAO.load();
        } catch (Exception e) {
            System.out.println("Nenhum cliente carregado.");
            customerList = new ArrayList<>();
        }

        try {
            exercisesList = ExerciseDAO.load();
        } catch (Exception e) {
            System.out.println("Nenhum exercício carregado.");
            exercisesList = new ArrayList<>();
        }

        try {
            trainingList = TrainingDAO.load();
        } catch (Exception e) {
            System.out.println("Nenhum treino carregado.");
            trainingList = new ArrayList<>();
        }

        CustomerController customerController = new CustomerController(customerList);
        ExerciseController exerciseController = new ExerciseController(exercisesList);
        TrainingController trainingController = new TrainingController(trainingList);

        Scanner entry = new Scanner(System.in);
        boolean itsExecuting = true;

        while (itsExecuting) {
            System.out.println("\nBem-vindo ao sistema gerenciador de Academia!");
            System.out.println("1 - Gerenciar clientes");
            System.out.println("2 - Gerenciar exercícios");
            System.out.println("3 - Gerenciar treinos");
            System.out.println("4 - Calcular fatorial");
            System.out.println("0 - Sair");
            System.out.print("Escolha uma opção: ");
            String option = entry.hasNextLine() ? entry.nextLine() : "0";

            switch (option) {
                case "1":
                    CustomerView.menu(customerController, entry);
                    break;
                case "2":
                    ExerciseView.menu(exerciseController, entry);
                    break;
                case "3":
                    TrainingView.menu(customerController, exerciseController, trainingController, trainingList, entry);
                    break;
                case "4":
                    System.out.print("Digite um número para calcular o fatorial: ");
                    try {
                        int num = Integer.parseInt(entry.nextLine());
                        int resultado = 1;
                        for (int i = 1; i <= num; i++) {
                            resultado *= i;
                        }
                        System.out.println("Fatorial de " + num + " é " + resultado);
                    } catch (NumberFormatException e) {
                        System.out.println("Entrada inválida. Digite um número inteiro.");
                    }
                    break;
                case "0":
                    itsExecuting = false;
                    System.out.println("Encerrando o sistema.");
                    try {
                        CustomerDAO.save(customerController.getAllCustomers());
                        ExerciseDAO.save(exerciseController.getAllExercises());
                        TrainingDAO.save(trainingList);
                        System.out.println("Dados salvos com sucesso!");
                    } catch (IOException e) {
                        System.err.println("Erro I/O ao salvar dados: " + e.getMessage());
                    } catch (Exception e) {
                        System.out.println("Erro inesperado: " + e.getMessage());
                    }
                    break;
                default:
                    System.out.println("Opção inválida.");
            }
        }

        entry.close();
    }
}