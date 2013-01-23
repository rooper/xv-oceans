
//TODO
//should log this shit to a file

String address = "http://169.254.63.189"; 
float[] graph0;
float[] graph1;
float[] graph2;
float[] graph3;
PFont f;

void setup() {
  size(400,800);
  smooth();
  // An array of random values
  graph0 = new float[width];
  for (int i = 0; i < graph0.length; i++) {
    graph0[i] = 0;
    
  }
  graph1 = new float[width];
  for (int i = 0; i < graph1.length; i++) {
    graph1[i] = 0;
    
  }
  graph2 = new float[width];
  for (int i = 0; i < graph2.length; i++) {
    graph2[i] = 0;
    
  }
  graph3 = new float[width];
  for (int i = 0; i < graph3.length; i++) {
    graph3[i] = 0;
    
  }
  //drawing stuff
  f = createFont("Arial",16,true);
  
}



void draw() {

  background(255);
  String[] in_data = loadStrings(address);
  println("in data[0] is "+in_data[0]);
  String[] data = split(in_data[0],',');
  int num0 = int(data[0]);
  int num1 = int(data[1]);
  int num2 = int(data[2]);
  //normalize light
  num2 = (num2 / 10);
  int num3 = int(data[3]);
  // Draw lines connecting all points for grpah 0
  stroke(0);
  strokeWeight(2);
  for (int i = 0; i < graph0.length-1; i++) {
    line(i,graph0[i],i+1,graph0[i+1]);
  }
   // Draw lines connecting all points for graph 1
  for (int i = 0; i < graph1.length-1; i++) {
    line(i,graph1[i]+200,i+1,graph1[i+1]+200);
  }
     // Draw lines connecting all points for graph 2
  for (int i = 0; i < graph2.length-1; i++) {
    line(i,graph2[i]+400,i+1,graph2[i+1]+400);
  }
   for (int i = 0; i < graph3.length-1; i++) {
    line(i,graph3[i]+600,i+1,graph3[i+1]+600);
  }
 
  
  //draw new line graph 0
   for (int i = 0; i < graph0.length-1; i++) {
    line(i,graph0[i],i+1,graph0[i+1]);
  }
  //draw new line graph 1
   for (int i = 0; i < graph1.length-1; i++) {
    line(i,graph1[i]+200,i+1,graph1[i+1]+200);
  }
  //draw new line graph 2
   for (int i = 0; i < graph2.length-1; i++) {
    line(i,graph2[i]+400,i+1,graph2[i+1]+400);
  }
    for (int i = 0; i < graph3.length-1; i++) {
    line(i,graph3[i]+600,i+1,graph3[i+1]+600);
  }
  
  // Slide everything down in the array for graph 0
  for (int i = 0; i < graph0.length-1; i++) {
    graph0[i] = graph0[i+1]; 
  }
   // Slide everything down in the array for graph 1
  for (int i = 0; i < graph1.length-1; i++) {
    graph1[i] = graph1[i+1]; 
  }
    // Slide everything down in the array for graph 1
  for (int i = 0; i < graph2.length-1; i++) {
    graph2[i] = graph2[i+1]; 
  }
     // Slide everything down in the array for graph 1
  for (int i = 0; i < graph3.length-1; i++) {
    graph3[i] = graph3[i+1]; 
  }
  // Add a new random value graph 0
  graph0[graph0.length-1] = num0; //+= random(-10,10)
   // Add a new random value graph 1
  graph1[graph1.length-1] = num1; //+= random(-10,10)
   // Add a new random value graph 1
  graph2[graph2.length-1] = num2; //+= random(-10,10)
   
  graph3[graph3.length-1] = num3; //+= random(-10,10)

   //draw dividing line
  stroke(255,0,0);
  strokeWeight(3);
  line(0,200,400,200);
  line(0,400,400,400);
  line(0,600,400,600);
  
  
  //draw labels and bounding boxes
  //half transparent boxes
  fill(255,0,0,215);
  rect(0,0,85,25);
  rect(0,200,115,25);
  rect(0,400,90,25);
  rect(0,600,90,25);
  textFont(f,16);
  //draw text
  fill(0);
  text("int temp (F) ",3,16);
  text("int humidity (%) ",3,216);
  text("int light (V) ",3,416);
  text("ext temp (F) ",3,616);
  
}
