<?php

$books = []; // Initialize an empty array to store book data

function addBook(&$books) {
    $title = readline("Enter the book title: ");
    $author = readline("Enter the author: ");
    $year = readline("Enter the year of publication: ");

    $books[] = ['title' => $title, 'author' => $author, 'year' => $year];
    echo "Book added successfully!\n";
}

function viewBooks($books) {
    if (empty($books)) {
        echo "No books in the library yet.\n";
        return;
    }

    echo "\nLibrary Books:\n";
    foreach ($books as $index => $book) {
        echo ($index + 1) . ". Title: {$book['title']}, Author: {$book['author']}, Year: {$book['year']}\n";
    }
}

function searchBook($books) {
    $title = readline("Enter the title of the book to search: ");
    foreach ($books as $index => $book) {
        if ($book['title'] === $title) {
            echo "Book found!\n";
            echo "Title: {$book['title']}, Author: {$book['author']}, Year: {$book['year']}\n";
            return;
        }
    }
    echo "Book not found.\n";
}

function deleteBook(&$books) {
    $title = readline("Enter the title of the book to delete: ");
    foreach ($books as $index => $book) {
        if ($book['title'] === $title) {
            unset($books[$index]);
            $books = array_values($books); // Re-index the array
            echo "Book deleted successfully!\n";
            return;
        }
    }
    echo "Book not found.\n";
}

while (true) {
    echo "\nLibrary Management System\n";
    echo "1. Add Book\n";
    echo "2. View Books\n";
    echo "3. Search Book\n";
    echo "4. Delete Book\n";
    echo "5. Exit\n";
    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case 1:
            addBook($books);
            break;
        case 2:
            viewBooks($books);
            break;
        case 3:
            searchBook($books);
            break;
        case 4:
            deleteBook($books);
            break;
        case 5:
            exit();
        default:
            echo "Invalid choice!\n";
    }
}