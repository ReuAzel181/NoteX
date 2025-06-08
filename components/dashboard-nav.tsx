"use client"

import * as React from "react"
import Link from "next/link"
import { usePathname } from "next/navigation"
import { useTheme } from "next-themes"
import { Button } from "@/components/ui/button"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Moon, Sun, Home, BookOpen, Calculator, Edit3, PenTool, Menu, Sparkles, Zap } from "lucide-react"
import {
  Sheet,
  SheetContent,
  SheetTrigger,
} from "@/components/ui/sheet"

const tools = [
  {
    title: "Home",
    href: "/",
    icon: Home,
    color: "from-blue-500 to-cyan-500"
  },
  {
    title: "Notes",
    href: "/tools/notes",
    icon: Edit3,
    color: "from-cyan-500 to-blue-500"
  },
  {
    title: "Draw",
    href: "/tools/draw",
    icon: PenTool,
    color: "from-emerald-500 to-green-500"
  },
  {
    title: "Calculator",
    href: "/tools/calculator",
    icon: Calculator,
    color: "from-purple-500 to-indigo-500"
  },
  {
    title: "Dictionary",
    href: "/tools/dictionary",
    icon: BookOpen,
    color: "from-orange-500 to-red-500"
  }
]

export function DashboardNav() {
  const { setTheme } = useTheme()
  const pathname = usePathname()

  return (
    <header className="flex items-center justify-between p-6 border-b border-white/10 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl relative overflow-hidden">
      {/* Animated Background Elements */}
      <div className="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-purple-500/5 to-cyan-500/5"></div>
      <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-cyan-500"></div>
      
      {/* Floating Particles */}
      <div className="absolute top-4 left-1/4 w-1 h-1 bg-blue-400 rounded-full animate-ping"></div>
      <div className="absolute top-8 right-1/3 w-0.5 h-0.5 bg-purple-400 rounded-full animate-pulse" style={{animationDelay: '1s'}}></div>
      <div className="absolute bottom-4 left-1/2 w-1 h-1 bg-cyan-400 rounded-full animate-bounce" style={{animationDelay: '2s'}}></div>
      
      <Link href="/" className="flex items-center space-x-3 group relative z-10">
        <div className="relative">
          <Sparkles className="h-8 w-8 text-blue-500 group-hover:text-purple-500 transition-all duration-500 animate-pulse" />
          <div className="absolute inset-0 bg-blue-500/30 rounded-full blur-lg group-hover:bg-purple-500/30 transition-all duration-500 animate-pulse"></div>
          <div className="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <div className="relative">
          <span className="text-3xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-600 bg-clip-text text-transparent group-hover:from-purple-600 group-hover:via-cyan-600 group-hover:to-blue-600 transition-all duration-500 animate-text-gradient">
            NoteX
          </span>
          <div className="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-500"></div>
        </div>
        <div className="relative opacity-0 group-hover:opacity-100 transition-opacity duration-500">
          <Zap className="h-6 w-6 text-yellow-500 animate-bounce" />
          <div className="absolute inset-0 bg-yellow-500/30 rounded-full blur-sm animate-pulse"></div>
        </div>
      </Link>
      
      <div className="flex items-center space-x-4 relative z-10">
        {/* Desktop Navigation */}
        <nav className="hidden md:flex items-center space-x-2">
          {tools.map((tool) => {
            const isActive = pathname === tool.href
            const Icon = tool.icon
            return (
              <Link 
                key={tool.href} 
                href={tool.href}
                className={`flex items-center space-x-2 px-4 py-3 rounded-xl transition-all duration-500 relative overflow-hidden group ${
                  isActive 
                    ? `bg-gradient-to-r ${tool.color} text-white shadow-lg shadow-blue-500/25 scale-105` 
                    : "hover:bg-gradient-to-r hover:from-gray-100/50 hover:to-gray-200/50 dark:hover:from-slate-700/50 dark:hover:to-slate-600/50 hover:text-gray-800 dark:hover:text-gray-200 hover:scale-105"
                }`}
              >
                <div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                <div className="relative z-10">
                  <Icon className={`h-5 w-5 ${isActive ? 'animate-pulse' : 'group-hover:animate-bounce'}`} />
                </div>
                <span className="relative z-10 font-semibold">{tool.title}</span>
                
                {/* Active Indicator */}
                {isActive && (
                  <div className="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-6 h-1 bg-white rounded-full animate-pulse"></div>
                )}
              </Link>
            )
          })}
        </nav>

        {/* Mobile Navigation */}
        <Sheet>
          <SheetTrigger asChild className="md:hidden">
            <Button variant="outline" size="icon" className="border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70 transition-all duration-300 hover:scale-110">
              <Menu className="h-5 w-5" />
              <span className="sr-only">Toggle menu</span>
            </Button>
          </SheetTrigger>
          <SheetContent side="right" className="bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-l border-white/20">
            <nav className="flex flex-col gap-4 mt-8">
              {tools.map((tool) => {
                const isActive = pathname === tool.href
                const Icon = tool.icon
                return (
                  <Link 
                    key={tool.href} 
                    href={tool.href}
                    className={`flex items-center space-x-3 p-4 rounded-xl transition-all duration-500 ${
                      isActive 
                        ? `bg-gradient-to-r ${tool.color} text-white shadow-lg` 
                        : "hover:bg-gradient-to-r hover:from-gray-100/50 hover:to-gray-200/50 dark:hover:from-slate-700/50 dark:hover:to-slate-600/50 hover:text-gray-800 dark:hover:text-gray-200"
                    }`}
                  >
                    <Icon className={`h-6 w-6 ${isActive ? 'animate-pulse' : ''}`} />
                    <span className="font-semibold">{tool.title}</span>
                  </Link>
                )
              })}
            </nav>
          </SheetContent>
        </Sheet>

        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="outline" size="icon" className="border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70 transition-all duration-300 hover:scale-110 relative overflow-hidden group">
              <div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-500"></div>
              <Sun className="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0 relative z-10" />
              <Moon className="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100 relative z-10" />
              <span className="sr-only">Toggle theme</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end" className="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl border border-white/20">
            <DropdownMenuItem onClick={() => setTheme("light")} className="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-slate-700/50 dark:hover:to-slate-600/50 transition-all duration-300">
              <Sun className="h-4 w-4 mr-2 text-yellow-500" />
              Light
            </DropdownMenuItem>
            <DropdownMenuItem onClick={() => setTheme("dark")} className="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-slate-700/50 dark:hover:to-slate-600/50 transition-all duration-300">
              <Moon className="h-4 w-4 mr-2 text-blue-500" />
              Dark
            </DropdownMenuItem>
            <DropdownMenuItem onClick={() => setTheme("system")} className="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-slate-700/50 dark:hover:to-slate-600/50 transition-all duration-300">
              <Sparkles className="h-4 w-4 mr-2 text-purple-500" />
              System
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </div>
    </header>
  )
} 