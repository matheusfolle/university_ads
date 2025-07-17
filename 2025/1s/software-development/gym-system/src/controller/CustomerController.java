package controller;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;
import model.*;

public class CustomerController {
    private List<Customer> customers;

    public CustomerController(List<Customer> customers) {
        this.customers = (customers != null) ? customers : new ArrayList<>();
    }

    public void registerCustomer(String name, LocalDate birthDate, Objective objective) {
        Customer c = new Customer((ArrayList) customers, name, birthDate, objective);
        customers.add(c);
    }

    public boolean removeCustomer(int id) {
        return customers.removeIf(c -> ((Customer) c).getId() == id);
    }

    public List<Customer> getAllCustomers() {
        return customers;
    }

    public Customer findCustomerById(int id) {
        for (Object c : customers) {
            if (((Customer) c).getId() == id) 
                return (Customer) c;
        }
        return null;
    }

    public void addTraining(int customerId, Training training) {
        Customer c = findCustomerById(customerId);
        if (c != null) c.addTraining(training);
    }

    public boolean removeTraining(int customerId, int trainingId) {
        Customer c = findCustomerById(customerId);
        return (c != null) && c.removeTrainingById(trainingId);
    }

    public boolean isEnrolled(int customerId) {
        Customer c = findCustomerById(customerId);
        return c != null && c.isEnrolled();
    }
}