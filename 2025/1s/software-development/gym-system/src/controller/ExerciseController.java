package controller;

import java.util.ArrayList;
import java.util.List;
import model.Exercise;

public class ExerciseController {
    private List<Exercise> exercises;

    public ExerciseController(List<Exercise> exercises) {
        this.exercises = (exercises != null) ? exercises : new ArrayList<>();
    }

    public void registerExercise(String name, String repetitions, String sets) {
        Exercise e = new Exercise(name, repetitions, sets, exercises);
        exercises.add(e);
    }

    public boolean removeExercise(int id) {
        return exercises.removeIf(e -> e.getId() == id);
    }

    public List<Exercise> getAllExercises() {
        return exercises;
    }

    public Exercise findExerciseById(int id) {
        for (Exercise e : exercises) {
            if (e.getId() == id) return e;
        }
        return null;
    }
}