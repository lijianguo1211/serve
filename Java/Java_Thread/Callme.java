package thread;

public class Callme {

    public void call(String msg) {
        System.out.println("[-"+msg);

        try {
            Thread.sleep(1000);
        } catch (InterruptedException e) {
            System.out.println("InterruptedException");
        }
        System.out.println("-]");
    }

}
