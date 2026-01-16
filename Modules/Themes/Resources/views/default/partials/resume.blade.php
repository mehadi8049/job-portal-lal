 <style>
     :root {
         --res-blue-dark: #273c75;
         --res-blue-mid: #192a56;
         --res-accent: #0097e6;
         --res-slate: #353b48;
     }

     .resume-section {
         padding: 50px 0;
         background: #ffffff;
     }

     /* Header Styling */
     .res-header {
         text-align: center;
         margin-bottom: 40px;
     }

     .res-header h2 {
         font-weight: 800;
         font-size: 2.2rem;
         color: #2f3640;
         letter-spacing: -0.5px;
     }

     .res-header h2 i {
         color: var(--res-accent);
         margin-right: 12px;
         font-weight: bold;
     }

     .res-subtitle {
         font-size: 1rem;
         color: #7f8c8d;
     }

     /* The Process Container */
     .res-container {
         display: flex;
         align-items: center;
         margin-bottom: 45px;
         filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.08));
     }

     /* Individual Arrow Step */
     .res-step {
         position: relative;
         flex: 1;
         padding: 30px 15px;
         color: white;
         text-align: center;
         /* Arrow Clip Path */
         clip-path: polygon(0% 0%, 92% 0%, 100% 50%, 92% 100%, 0% 100%, 8% 50%);
         margin-right: -12px;
         transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
     }

     /* Edge Logic */
     .res-step:first-child {
         clip-path: polygon(0% 0%, 92% 0%, 100% 50%, 92% 100%, 0% 100%);
         border-radius: 10px 0 0 10px;
     }

     .res-step:last-child {
         clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 8% 50%);
         border-radius: 0 10px 10px 0;
         margin-right: 0;
     }

     .res-step:hover {
         transform: scale(1.03);
         z-index: 5;
         filter: contrast(1.1) brightness(1.1);
         cursor: pointer;
     }

     .res-step i {
         font-size: 30px;
         margin-bottom: 10px;
         display: block;
     }

     .res-step h5 {
         font-size: 1rem;
         font-weight: 700;
         margin-bottom: 5px;
         text-transform: uppercase;
     }

     .res-step p {
         font-size: 0.7rem;
         opacity: 0.85;
         line-height: 1.3;
         margin-bottom: 0;
     }

     /* Palette for Resume Builder */
     .res-bg-1 {
         background-color: var(--res-blue-dark);
     }

     .res-bg-2 {
         background-color: var(--res-accent);
     }

     .res-bg-3 {
         background-color: var(--res-blue-mid);
     }

     .res-bg-4 {
         background-color: var(--res-slate);
     }

     /* Navigation Button */
     .btn-resume {
         background: var(--res-accent);
         color: #fff;
         padding: 12px 20px;
         border-radius: 50px;
         font-weight: 600;
         border: none;
         transition: 0.3s;
         display: inline-flex;
         align-items: center;
         text-decoration: none;
     }

     .btn-resume:hover {
         background: var(--res-blue-dark);
         color: #fff;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
     }

     @media (max-width: 991px) {
         .res-container {
             flex-direction: column;
         }

         .res-step {
             width: 100%;
             margin-right: 0;
             margin-bottom: 8px;
             clip-path: none !important;
             border-radius: 8px !important;
         }
     }
 </style>

 <section class="resume-section">
     <div class="container">
         <div class="res-header">
             <span class="badge badge-primary px-3 mb-2" style="background-color: var(--res-accent);">QUICK BUILD</span>
             <h2><i class="pe-7s-news-paper"></i>Resume Builder</h2>
             <p class="res-subtitle">Streamlined 1-page professional resume creator.</p>
         </div>

         <div class="res-container">
             <div class="res-step res-bg-1">
                 <i class="pe-7s-rocket"></i>
                 <h5>Pick Layout</h5>
                 <p>Choose a compact, impactful template.</p>
             </div>
             <div class="res-step res-bg-2">
                 <i class="pe-7s-bookmarks"></i>
                 <h5>Key Skills</h5>
                 <p>Add industry keywords for ATS optimization.</p>
             </div>
             <div class="res-step res-bg-3">
                 <i class="pe-7s-graph1"></i>
                 <h5>Achievements</h5>
                 <p>Quantify your results with data points.</p>
             </div>
             <div class="res-step res-bg-4">
                 <i class="pe-7s-check"></i>
                 <h5>Finalize</h5>
                 <p>Preview, polish, and export in PDF.</p>
             </div>
         </div>

         <div class="text-center">
             <a href="{{ url('templates') }}" class="btn-resume">
                 Start My Resume <i class="pe-7s-angle-right-circle ml-2" style="font-size: 1.4rem;"></i>
             </a>
         </div>
     </div>
 </section>
