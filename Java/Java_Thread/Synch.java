package thread;

public class Synch {
       public static void main(String args[]) {
            Callme target = new Callme();
            Caller c1 = new Caller(target,"Hello");
            Caller c2 = new Caller(target,"Liyi");
            Caller c3 = new Caller(target,"SanSanSan");

            try {
                   c1.t.join();
                   c2.t.join();
                   c3.t.join();
            } catch (InterruptedException e) {
                   System.out.println("InterruptedException+++++++Synch");
            }
       }
}
