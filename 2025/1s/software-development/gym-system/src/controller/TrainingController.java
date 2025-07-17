package controller;

import factory.TrainingFactory;
import java.util.List;
import model.*;

public class TrainingController {
    private final List<Training> trainingList;

    public TrainingController(List<Training> trainingList) {
        this.trainingList = trainingList;
    }

    public Training createInternet(String duration, TrainingType type, List<MuscleGroup> muscleGroups, List<Exercise> exercises, String source) {
        return TrainingFactory.createInternetTraining(trainingList, duration, type, muscleGroups, exercises, source);
    }

    public Training createInnerGym(String duration, TrainingType type, List<MuscleGroup> muscleGroups, List<Exercise> exercises, String instructor, String gymPeriod) {
        return TrainingFactory.createInnerGymTraining(trainingList, duration, type, muscleGroups, exercises, instructor, gymPeriod);
    }

    public Training createPersonal(String duration, TrainingType type, List<MuscleGroup> muscleGroups, List<Exercise> exercises, String personalTrainer, String personalPeriod) {
        return TrainingFactory.createPersonalTraining(trainingList, duration, type, muscleGroups, exercises, personalTrainer, personalPeriod);
    }

    public List<Training> getAllTrainings() {
        return trainingList;
    }
}