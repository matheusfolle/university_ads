package model;

import interfaces.Registrable;
import java.io.Serializable;
import java.time.LocalDate;
import java.time.Period;
import java.util.ArrayList;
import java.util.List;

public class Customer implements Registrable, Serializable {
    private int id;
    private String name;
    private LocalDate birthDate;
    private Objective objective;
    private List trainingSessions;

    public Customer(List<Customer> allCustomers, String name, LocalDate birthDate, Objective objective) {
        this.id = generateCustomerId(allCustomers);
        this.name = name;
        this.birthDate = birthDate;
        this.objective = objective;
        this.trainingSessions = new ArrayList();
    }

    private int generateCustomerId(List<Customer> allCustomers) {
        return allCustomers.stream()
                .mapToInt(c -> c.getId())
                .max()
                .orElse(0) + 1;
    }

    public void addTraining(Object training) {
        trainingSessions.add(training);
    }

    public boolean removeTrainingById(int trainingId) {
        return trainingSessions.removeIf(t -> ((Training) t).getId() == trainingId);
    }

    public boolean isEnrolled() {
        return !trainingSessions.isEmpty();
    }

    public int getAge() {
        return Period.between(birthDate, LocalDate.now()).getYears();
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public LocalDate getBirthDate() {
        return birthDate;
    }

    public Objective getObjective() {
        return objective;
    }

    public List getTrainingSessions() {
        return trainingSessions;
    }

    public String getSummary() {
        return "Cliente: " + name + ", idade: " + getAge() + " anos, objetivo: " + objective.getDescricao();
    }

    public String toString() {
        StringBuilder result = new StringBuilder("Cliente:\n" +
                "ID: " + id + "\n" +
                "Nome: " + name + "\n" +
                "Idade: " + getAge() + " anos\n" +
                "Nascimento: " + birthDate + "\n" +
                "Objetivo: " + objective.getDescricao() + "\n" +
                "Treinos:\n\n");

        for (Object t : trainingSessions) {
            Training training = (Training) t;
            result.append("Resumo: ").append(training.getSummary()).append("\n\n");
        }

        return result.toString();
    }
}