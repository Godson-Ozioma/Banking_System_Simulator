import java.util.HashMap;
import java.util.Map;
import java.util.Scanner;

public class BankingSystem {
    private Map<String, Double> accounts = new HashMap<>();

    public void createAccount(String accountName) {
        accounts.put(accountName, 0.0); // Initial balance is zero
        System.out.println("Account created for " + accountName);
    }

    public void deposit(String accountName, double amount) {
        if (amount > 0) {
            accounts.put(accountName, accounts.getOrDefault(accountName, 0.0) + amount);
            System.out.println("Deposited $" + amount + " into " + accountName + "'s account.");
        } else {
            System.out.println("Invalid deposit amount.");
        }
    }

    public void withdraw(String accountName, double amount) {
        double currentBalance = accounts.getOrDefault(accountName, 0.0);
        if (amount > 0 && amount <= currentBalance) {
            accounts.put(accountName, currentBalance - amount);
            System.out.println("Withdrew $" + amount + " from " + accountName + "'s account.");
        } else {
            System.out.println("Insufficient funds or invalid withdrawal amount.");
        }
    }

    public void checkBalance(String accountName) {
        double balance = accounts.getOrDefault(accountName, -1.0); // -1 indicates account not found
        if (balance >= 0) {
            System.out.println(accountName + "'s balance: $" + balance);
        } else {
            System.out.println("Account not found.");
        }
    }

    public void runMenu() {
        Scanner scanner = new Scanner(System.in);
        String accountName;

        while (true) {
            System.out.println("\nBanking System Menu:");
            System.out.println("1. Create Account");
            System.out.println("2. Deposit");
            System.out.println("3. Withdraw");
            System.out.println("4. Check Balance");
            System.out.println("5. Exit");
            System.out.print("Enter your choice: ");

            int choice = scanner.nextInt();
            scanner.nextLine(); // Consume newline

            switch (choice) {
                case 1:
                    System.out.print("Enter account name: ");
                    accountName = scanner.nextLine();
                    createAccount(accountName);
                    break;
                case 2:
                case 3:
                case 4:
                    System.out.print("Enter account name: ");
                    accountName = scanner.nextLine();
                    if (accounts.containsKey(accountName)) {
                        System.out.print("Enter amount: $");
                        double amount = scanner.nextDouble();
                        if (choice == 2) {
                            deposit(accountName, amount);
                        } else if (choice == 3) {
                            withdraw(accountName, amount);
                        } else {
                            checkBalance(accountName);
                        }
                    } else {
                        System.out.println("Account not found.");
                    }
                    scanner.nextLine(); // Consume newline
                    break;
                case 5:
                    System.out.println("Exiting banking system.");
                    scanner.close();
                    return;
                default:
                    System.out.println("Invalid choice.");
            }
        }
    }

    public static void main(String[] args) {
        BankingSystem bank = new BankingSystem();
        bank.runMenu();
    }
}