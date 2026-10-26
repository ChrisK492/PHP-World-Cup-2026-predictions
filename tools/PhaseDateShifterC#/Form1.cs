using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Runtime.InteropServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace PhaseDateShifter
{
    public partial class Form1 : Form
    {
        [StructLayout(LayoutKind.Sequential)]
        public struct SYSTEMTIME
        {
            public short wYear;
            public short wMonth;
            public short wDayOfWeek;
            public short wDay;
            public short wHour;
            public short wMinute;
            public short wSecond;
            public short wMilliseconds;
        }


        Dictionary<string, SYSTEMTIME> times = new Dictionary<string, SYSTEMTIME>();


        [DllImport("kernel32.dll", SetLastError = true)]
        public static extern bool SetSystemTime(ref SYSTEMTIME st);

        public Form1()
        {
            InitializeComponent();
            InitializeTimes2();
        }

        private void InitializeTimes2()
        {
            times.Add("PFOPEN", CreateTime("2022-1-1 12:00:00"));
            times.Add("PFCLOSE", CreateTime("2022-11-20 16:59:55"));

            times.Add("EFOPEN", CreateTime("2022-12-2 23:59:55"));
            times.Add("EFCLOSE", CreateTime("2022-12-03 15:59:55"));

            times.Add("KFOPEN", CreateTime("2022-12-06 23:59:55"));
            times.Add("KFCLOSE", CreateTime("2022-12-09 15:59:55"));

            times.Add("HFOPEN", CreateTime("2022-12-10 23:59:55"));
            times.Add("HFCLOSE", CreateTime("2022-12-13 19:59:55"));

            times.Add("FOPEN", CreateTime("2022-12-14 23:59:55"));
            times.Add("FCLOSE", CreateTime("2022-12-17 15:59:55"));
        }

        private SYSTEMTIME CreateTime(string aDateString)
        {
            DateTime temp = DateTime.Parse(aDateString);
            DateTime universal = temp.ToUniversalTime();

            SYSTEMTIME st = new SYSTEMTIME();
            st.wYear = (short)universal.Year; // must be short
            st.wMonth = (short)universal.Month;
            st.wDay = (short)universal.Day;
            st.wHour = (short)universal.Hour;
            st.wMinute = (short)universal.Minute;
            st.wSecond = (short)universal.Second;
            st.wMilliseconds = 0;

            return st;
        }

        private void SetSystemDate(SYSTEMTIME aTime)
        {
            SetSystemTime(ref aTime);            
        }

        private void PFOpenButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["PFOPEN"]);
        }

        private void PFCloseButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["PFCLOSE"]);
        }

        private void EFOpenButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["EFOPEN"]);
        }

        private void EFCloseButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["EFCLOSE"]);
        }

        private void KFOpenButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["KFOPEN"]);
        }

        private void KFCloseButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["KFCLOSE"]);
        }

        private void HFOpenButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["HFOPEN"]);
        }

        private void HFCloseButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["HFCLOSE"]);
        }

        private void FOpenButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["FOPEN"]);
        }

        private void FCloseButton_Click(object sender, EventArgs e)
        {
            SetSystemDate(times["FCLOSE"]);
        }

        /*private SYSTEMTIME CreateTime(short aYear, short aMonth, short aDay, short aHour, short aMinute, short aSecond) {
            DateTime temp = new DateTime(aYear, aMonth, aDay, aHour, aMinute, aSecond);
            DateTime universal = temp.ToUniversalTime();
            
            SYSTEMTIME st = new SYSTEMTIME();
            st.wYear = (short)universal.Year; // must be short
            st.wMonth = (short)universal.Month;
            st.wDay = (short)universal.Day;
            st.wHour = (short)universal.Hour;
            st.wMinute = (short)universal.Minute;
            st.wSecond = (short)universal.Second;
            st.wMilliseconds = 0;

            return st;
        }*/

        /*private void InitializeTimes()
        {
            times.Add("PFOPEN", CreateTime2("2022-1-1 12:00:00"));
            times.Add("PFCLOSE", CreateTime(2022, 11, 20, 16 - 2, 59, 58));

            times.Add("EFOPEN", CreateTime(2022, 12, 2, 23 - 1, 59, 58));
            times.Add("EFCLOSE", CreateTime(2022, 12, 3, 16 - 2, 59, 58));

            times.Add("KFOPEN", CreateTime(2022, 12, 6, 23 - 1, 59, 58));
            times.Add("KFCLOSE", CreateTime(2022, 12, 9, 16 - 2, 59, 58));

            times.Add("HFOPEN", CreateTime(2022, 12, 10, 23 - 1, 59, 58));
            times.Add("HFCLOSE", CreateTime(2022, 12, 13, 20 - 2, 59, 58));

            times.Add("FOPEN", CreateTime(2022, 12, 14, 23 - 1, 59, 58));
            times.Add("FCLOSE", CreateTime(2022, 12, 18, 16 - 2, 59, 58));
        }*/
    }
}
