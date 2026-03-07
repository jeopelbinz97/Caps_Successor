import { useEffect, useState, useRef } from "react";
import { useNavigate } from "react-router-dom";
import SideBarToolTip from "./sidebarTooltip";
import useToast from "../hooks/useToast";

// Helper function to transform program names
const getDisplayProgramName = (programName) => {
  if (programName === "GE") {
    return "General Subject";
  }
  return programName;
};

const Questionnare = ({
  item,
  isExpanded,
  setIsExpanded,
  setSelectedSubject,
  setIsSubjectFocused,
  homePath,
  className,
  selectedSubject,
}) => {
  return (
    <div className="">
      <li className="relative flex cursor-pointer items-center gap-3 rounded-md px-[8px] py-[4px] sm:hover:bg-gray-100">
        <span className="hidden sm:inline">
          <div className="flex items-center gap-3" onClick={() => alert("Under development")}>
            <i
              className={`bx ${item.icon} ${className} shrink-0 text-2xl text-gray-700 hover:text-gray-800 sm:pt-1 sm:text-2xl`}
            ></i>
            <span className="overflow-hidden whitespace-nowrap opacity-0 transition-all duration-300 group-hover:opacity-100 text-[14px] font-medium text-gray-700">
              Quizzes
            </span>
          </div>
        </span>
        {/* Always show icon on mobile, but without tooltips */}
        <span className="sm:hidden">
          <i
            onClick={() => alert("Under development")}
            className={`bx ${item.icon} ${className} text-2xl text-gray-700 hover:text-gray-800 sm:pt-1 sm:text-2xl`}
          ></i>
        </span>
      </li>
    </div>
  );
};

export default Questionnare;
