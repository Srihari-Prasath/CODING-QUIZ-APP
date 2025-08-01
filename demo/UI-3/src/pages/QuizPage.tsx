import { useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { QuizInterface } from "@/components/quiz/QuizInterface";

// Mock quiz data
const mockQuizData = {
  id: "1",
  title: "Data Structures & Algorithms",
  duration: 90,
  questions: [
    {
      id: "q1",
      question: "What is the time complexity of searching in a binary search tree in the average case?",
      options: [
        "O(1)",
        "O(log n)",
        "O(n)",
        "O(n log n)"
      ],
      correctAnswer: 1
    },
    {
      id: "q2", 
      question: "Which data structure follows the Last In First Out (LIFO) principle?",
      options: [
        "Queue",
        "Stack",
        "Array",
        "Linked List"
      ],
      correctAnswer: 1
    },
    {
      id: "q3",
      question: "What is the space complexity of merge sort algorithm?",
      options: [
        "O(1)",
        "O(log n)",
        "O(n)",
        "O(n²)"
      ],
      correctAnswer: 2
    },
    {
      id: "q4",
      question: "In which traversal method of a binary tree do we visit the root node first?",
      options: [
        "Inorder",
        "Preorder", 
        "Postorder",
        "Level order"
      ],
      correctAnswer: 1
    },
    {
      id: "q5",
      question: "What is the worst-case time complexity of quick sort?",
      options: [
        "O(n log n)",
        "O(n)",
        "O(n²)",
        "O(log n)"
      ],
      correctAnswer: 2
    }
  ]
};

export default function QuizPage() {
  const { id } = useParams();
  const navigate = useNavigate();

  const handleSubmit = (answers: Record<string, number>) => {
    // Calculate score
    let correctCount = 0;
    mockQuizData.questions.forEach((question, index) => {
      if (answers[question.id] === question.correctAnswer) {
        correctCount++;
      }
    });

    const score = Math.round((correctCount / mockQuizData.questions.length) * 100);
    
    // Store results in sessionStorage for demo purposes
    const results = {
      quizId: id,
      score,
      correctCount,
      totalQuestions: mockQuizData.questions.length,
      answers,
      questions: mockQuizData.questions
    };
    
    sessionStorage.setItem('quizResults', JSON.stringify(results));
    navigate(`/results/${id}`);
  };

  return (
    <QuizInterface
      quizTitle={mockQuizData.title}
      questions={mockQuizData.questions}
      duration={mockQuizData.duration}
      onSubmit={handleSubmit}
    />
  );
}