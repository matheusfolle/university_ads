package view;

import controller.CustomerController;
import controller.ExerciseController;
import controller.TrainingController;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import model.*;

public abstract class TrainingView {
    public static void menu(CustomerController customerController, ExerciseController exerciseController, TrainingController trainingController, List<Training> trainingList, Scanner entry) {
        boolean itsExecuting = true;

        while (itsExecuting) {
            System.out.println("\nMenu de Treinos");
            System.out.println("1 - Adicionar treino para cliente");
            System.out.println("2 - Remover treino de cliente");
            System.out.println("0 - Voltar");
            System.out.print("Escolha uma opção: ");
            String option = entry.nextLine();

            switch (option) {
                case "1":
                    System.out.print("ID do cliente: ");
                    int customerId = Integer.parseInt(entry.nextLine());
                    Customer customer = customerController.findCustomerById(customerId);

                    System.out.println("Tipo de treino: 1 - Internet, 2 - Academia, 3 - Personal");
                    int trainingTypeOption = Integer.parseInt(entry.nextLine());

                    System.out.print("Duração estimada: ");
                    String duration = entry.nextLine();

                    System.out.println("Tipo físico: 1 - Musculação, 2 - Aeróbico, 3 - Corpo inteiro, 4 - Híbrido");
                    int trainingKindOption = Integer.parseInt(entry.nextLine());
                    TrainingType trainingType;

                    switch (trainingKindOption) {
                        case 2:
                            trainingType = TrainingType.AEROBIC;
                            break;
                        case 3:
                            trainingType = TrainingType.FULL_BODY;
                            break;
                        case 4:
                            trainingType = TrainingType.HYBRID;
                            break;
                        default:
                            trainingType = TrainingType.STRENGTH;
                    }

                    List<MuscleGroup> muscleGroups = new ArrayList<>();
                    System.out.println("Digite os grupos musculares separados por vírgula:");
                    String[] groupsInput = entry.nextLine().split(",");
                    for (String gg : groupsInput) {
                        for (MuscleGroup mg : MuscleGroup.values()) {
                            if (mg.getDescricao().equalsIgnoreCase(gg.trim())) {
                                muscleGroups.add(mg);
                                break;
                            }
                        }
                    }

                    List<Exercise> exercises = new ArrayList<>();
                    System.out.println("Exercícios disponíveis:");
                    for (Exercise e : exerciseController.getAllExercises()) {
                        System.out.println("ID: " + e.getId() + " | " + e);
                    }

                    System.out.println("Digite os IDs dos exercícios separados por vírgula:");
                    String[] selectedIds = entry.nextLine().split(",");
                    for (String idStr : selectedIds) {
                        try {
                            int id = Integer.parseInt(idStr.trim());
                            Exercise ex = exerciseController.findExerciseById(id);
                            if (ex != null) exercises.add(ex);
                        } catch (NumberFormatException e) {
                            System.out.println("ID inválido: " + idStr);
                        }
                    }

                    Training newTraining = null;
                    switch (trainingTypeOption) {
                        case 1:
                            System.out.print("Fonte online: ");
                            String source = entry.nextLine();
                            newTraining = trainingController.createInternet(duration, trainingType, muscleGroups, exercises, source);
                            break;
                        case 2:
                            System.out.print("Nome do instrutor: ");
                            String instructor = entry.nextLine();
                            System.out.print("Período recomendável: ");
                            String gymPeriod = entry.nextLine();
                            newTraining = trainingController.createInnerGym(duration, trainingType, muscleGroups, exercises, instructor, gymPeriod);
                            break;
                        case 3:
                            System.out.print("Nome do personal: ");
                            String personalTrainer = entry.nextLine();
                            System.out.print("Período recomendável: ");
                            String personalPeriod = entry.nextLine();
                            newTraining = trainingController.createPersonal(duration, trainingType, muscleGroups, exercises, personalTrainer, personalPeriod);
                            break;
                        default:
                            System.out.println("Tipo inválido.");
                            break;
                    }

                    if (newTraining != null) {
                        customerController.addTraining(customerId, newTraining);
                        trainingController.getAllTrainings().add(newTraining);
                        System.out.println("Treino adicionado com sucesso!");
                    }
                    break;

                case "2":
                    System.out.print("ID do cliente: ");
                    int custId = Integer.parseInt(entry.nextLine());
                    Customer cust = customerController.findCustomerById(custId);
                    System.out.println("Treinos cadastrados:");
                    for (Object t : cust.getTrainingSessions()) {
                        Training tCast = (Training) t;
                        System.out.println("ID: " + tCast.getId() + " | " + tCast.getTrainingType().getDescricao());
                    }
                    System.out.print("ID do treino a remover: ");
                    int trainingId = Integer.parseInt(entry.nextLine());
                    customerController.removeTraining(custId, trainingId);
                    System.out.println("Remoção solicitada.");
                    break;

                case "0":
                    itsExecuting = false;
                    break;

                default:
                    System.out.println("Opção inválida.");
                    break;
            }
        }
    }
}